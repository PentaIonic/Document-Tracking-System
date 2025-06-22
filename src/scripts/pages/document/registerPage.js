document.addEventListener("DOMContentLoaded", () => {
  const uploadedFilesList = document.getElementById("uploadList");
  const uploadBox = document.getElementById("uploadBox");
  const documentFile = document.getElementById("documentFile");

  // Autofills and changes form content based from different departments/sectors
  const params = new URLSearchParams(window.location.search);
  const department = params.get("department");

  // From PHP
  const submissionSuccess = window.submissionSuccess;
  const docCode = window.docCode;

  // Show success popup
  if (window.docCode && window.submissionSuccess === "1") {
    popSuccessPanel();

    // Remove query string from URL without reloading (after popup)
    window.history.replaceState(null, "", window.location.pathname);
  }

  // QR Code Generation
  if (typeof docCode !== "undefined" && docCode) {
    const registerQR = new QRCodeStyling({
      width: 200,
      height: 200,
      type: "png",
      data: `${window.location.origin}/document/track/index.php?code=${docCode}`,
      image: "../../assets/images/Santa_Elena_Camarines_Norte.png",
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

    const qrTarget = document.getElementById("qrDocument");
    if (qrTarget) {
      registerQR.append(qrTarget);
    }
  }

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
  });

  document.getElementById("submitData").addEventListener("click", () => {
    const form = document.getElementById("recordForm");
    if (form.checkValidity()) {
      form.submit();
    } else {
      form.reportValidity();
    }
  });
});

function gotoHome() {
  recordForm.reset();
  clearStoredData();
  window.location.href = `../../admin/`;
}

async function clearStoredData() {
  uploadedFilesList.innerHTML = "";
  uploadedFileInfo = null;
}

function handleSingleFile(input) {
  const uploadList = document.getElementById("uploadList");
  uploadList.innerHTML = ""; // Remove previous file preview

  if (input.files && input.files.length > 0) {
    const file = input.files[0];
    const preview = document.createElement("div");
    preview.innerHTML = `<img src="../../assets/icons/document-minus.svg" alt=""><span>${file.name}</span>`;
    uploadList.appendChild(preview);
  }
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
