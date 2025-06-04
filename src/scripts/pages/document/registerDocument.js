document.addEventListener("DOMContentLoaded", () => {
  const recordForm = document.getElementById("recordForm");
  const uploadBox = document.getElementById("uploadBox");
  const documentFile = document.getElementById("documentFile");
  const uploadedFilesList = document.getElementById("uploadList");

  // Supabase config
  const supabaseUrl = "https://qlgoqwvgtvydkuntjohg.supabase.co";
  const supabaseKey =
    "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFsZ29xd3ZndHZ5ZGt1bnRqb2hnIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDg0Mjg1OTgsImV4cCI6MjA2NDAwNDU5OH0.5H7UwMIuNi1k2bhdpknYxt6ub6UEtCgZNCBE02VP1Kk";
  const supabaseClient = supabase.createClient(supabaseUrl, supabaseKey);

  // Autofills and changes form content based from different departments/sectors
  const params = new URLSearchParams(window.location.search);
  const department = params.get("department");
  let transactionType;

  const docCode = generateDocumentCode(department);

  // QR Code Generation
  const registerQR = new QRCodeStyling({
    width: 200,
    height: 200,
    type: "svg",
    data: `${window.location.href}/viewDocument.html?codeDocument=${docCode}`,
    image: "../assets/icons/page-logo.svg",
    dotsOptions: {
      color: "var(--accent-color)",
      type: "classy-rounded",
    },
    backgroundOptions: {
      color: "var(--background-color)",
    },
    imageOptions: {
      margin: 10,
    },
  });
  registerQR.append(document.getElementById("qrDocument"));

  switch (department) {
    case "health-office":
      document.getElementById("sector").value = "Municipal Health Office";
      transactionType = document.getElementById("transactionType");
      transactionType.innerHTML = `
        <option>-Select-</option>
        <option>Health Certificate</option>
        <option>Hospital Referral Form</option>
        <option>Immunization Record</option>
        <option>Medical Certificate</option>
        <option>Prenatal Record</option>
        <option>Sanitary Permit</option>`;
      break;
    case "civil-registrar-office":
      document.getElementById("sector").value = "Civil Registrar Office";
      transactionType = document.getElementById("transactionType");
      transactionType.innerHTML = `
        <option>-Select-</option>
        <option>Birth Certificate</option>
        <option>CENOMAR</option>
        <option>Death Certificate</option>
        <option>Late Registration Request</option>
        <option>Marriage Certificate</option>`;
      break;
    case "gen-service-office":
      document.getElementById("sector").value = "General Services Office";
      transactionType = document.getElementById("transactionType");
      transactionType.innerHTML = `
        <option>-Select-</option>
        <option>Equipment Borrowing Form</option>
        <option>Inventory Report</option>
        <option>Maintenance Request</option>
        <option>Supply Request Form</option>`;
      break;
    case "agricultural-office":
      document.getElementById("sector").value = "Agriculture Office";
      transactionType = document.getElementById("transactionType");
      transactionType.innerHTML = `
        <option>-Select-</option>
        <option>Farm Equipment Loan Form</option>
        <option>Fertilizer Subsidy Application</option>
        <option>Immunization Record</option>
        <option>Livestock Vaccination Request</option>
        <option>Pre-Natal Record</option>`;
      break;
    case "accounting-office":
      document.getElementById("sector").value = "Accounting Office";
      transactionType = document.getElementById("transactionType");
      transactionType.innerHTML = `
        <option>-Select-</option>
        <option>Budget Utilization Request</option>
        <option>Disbursement Voucher</option>
        <option>Liquidation Report Submission</option>
        <option>Obligation Request & Status</option>
        <option>Payroll Certification Request</option>`;
      break;
  }

  // Upload Box Event Listeners
  uploadBox.addEventListener("click", () => documentFile.click());

  uploadBox.addEventListener("dragover", (e) => {
    e.preventDefault();
    uploadBox.classList.add("hover");
  });

  uploadBox.addEventListener("dragleave", () =>
    uploadBox.classList.remove("hover")
  );

  uploadBox.addEventListener("drop", async (e) => {
    e.preventDefault();
    uploadBox.classList.remove("hover");
    const files = e.dataTransfer.files;
    await handleFileUpload(files[0]);
  });

  documentFile.addEventListener("change", async () => {
    if (documentFile.files.length > 0) {
      await handleFileUpload(documentFile.files[0]);
    }
  });

  let uploadedFileInfo = null;

  // Handles file upload to Supabase Storage
  async function handleFileUpload(file) {
    if (!file) return;

    const filePath = `documents/${Date.now()}_${file.name}`;

    // Upload the file to Supabase Storage
    const { data: uploadData, error: uploadError } =
      await supabaseClient.storage.from("documents").upload(filePath, file);

    if (uploadError) {
      alert("Upload failed: " + uploadError.message);
      return;
    }

    // Generate public URL
    const { data: publicData, error: urlError } = supabaseClient.storage
      .from("documents")
      .getPublicUrl(filePath);

    if (urlError || !publicData || !publicData.publicUrl) {
      alert("Failed to get public URL.");
      return;
    }

    const publicUrl = publicData.publicUrl;

    // Save info for later use
    uploadedFileInfo = {
      name: file.name,
      url: publicUrl,
      uploadedAt: new Date().toISOString(),
    };

    renderUploadedFile(file.name, publicUrl);
  }

  function renderUploadedFile(name, url) {
    const li = document.createElement("li");
    li.innerHTML = `<a href="${url}" target="_blank">${name}</a>`;
    uploadedFilesList.appendChild(li);
  }

  function generateDocumentCode(department) {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, "0");
    const day = String(currentDate.getDate()).padStart(2, "0");

    let depCode = "";
    switch (department) {
      case "health-office":
        depCode = "HO";
        break;
      case "civil-registrar-office":
        depCode = "CRO";
        break;
      case "gen-service-office":
        depCode = "GSO";
        break;
      case "agricultural-office":
        depCode = "AGO";
        break;
      case "accounting-office":
        depCode = "ACO";
        break;
    }

    let endCode = Math.floor(Math.random() * 9999 + 1);
    return `${depCode}-${year}${month}${day}-${endCode}`;
  }

  // SUBMIT FORM
  document
    .getElementById("submitData")
    .addEventListener("click", recordDocument);

  async function recordDocument() {
    const formData = new FormData(recordForm);

    const requiredFields = [
      "lastName",
      "firstName",
      "middleName",
      "age",
      "sex",
      "address",
      "documentDate",
      "transactionType",
      "documentTitle",
    ];

    // Loop that checks for field values, if the field is empty or unselected it will prompt for user to try filling it out again the blank fields.
    for (const field of requiredFields) {
      const value = formData.get(field)?.trim();
      if (!value || value === "-Select-") {
        alert(`Please fill out the ${field.replace(/([A-Z])/g, " $1")} field.`);
        closePrompt();
        return;
      }
    }

    // Same logic for file
    if (!uploadedFileInfo) {
      alert("Please upload a document file before submitting.");
      closePrompt();
      return;
    }

    const suffixN = formData.get("suffixName").trim();
    if (!suffixN) {
      formData.set("suffixName", "N/A");
    }

    const documentDetails = {
      lastName: formData.get("lastName"),
      firstName: formData.get("firstName"),
      middleName: formData.get("middleName"),
      suffixName: formData.get("suffixName"),
      age: formData.get("age"),
      sex: formData.get("sex"),
      address: formData.get("address"),
      documentDate: formData.get("documentDate"),
      sector: department,
      transactionType: formData.get("transactionType"),
      documentCode: docCode,
      documentTitle: formData.get("documentTitle"),
      documentFile: uploadedFileInfo,
      documentURL: uploadedFileInfo?.url,
      documentStatus: "Pending",
    };

    const documentRecords =
      JSON.parse(localStorage.getItem("documentRecords")) || [];
    documentRecords.push(documentDetails);
    localStorage.setItem("documentRecords", JSON.stringify(documentRecords));

    popSuccessPanel();
    recordForm.reset();
    uploadedFilesList.innerHTML = null;
    uploadedFileInfo = null;
  }
});

function gotoHome() {
  recordForm.reset();
  clearStoredData();
  window.location.href = `../home.html`;
}

async function clearStoredData() {
  uploadedFilesList.innerHTML = "";
  uploadedFileInfo = null;
}

function closePrompt() {
  const promptSuccess = document.getElementById("success");
  const promptSubmit = document.getElementById("confirmSubmit");
  const promptCancel = document.getElementById("confirmCancel");

  promptSuccess.style.display = "none";
  promptSubmit.style.display = "none";
  promptCancel.style.display = "none";
}

function popSubmitConfirm() {
  const promptSubmit = document.getElementById("confirmSubmit");
  promptSubmit.style.display = "flex";
}

function popCancelConfirm() {
  const promptCancel = document.getElementById("confirmCancel");
  promptCancel.style.display = "flex";
}

function popSuccessPanel() {
  const promptSuccess = document.getElementById("success");
  const promptSubmit = document.getElementById("confirmSubmit");
  promptSubmit.style.display = "none";
  promptSuccess.style.display = "flex";
}
