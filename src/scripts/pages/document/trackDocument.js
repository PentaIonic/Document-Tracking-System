document.addEventListener("DOMContentLoaded", () => {
  // 1. Get stored records
  const documentRecords =
    JSON.parse(localStorage.getItem("documentRecords")) || [];

  // 2. Get ?docCode=XYZ from the URL
  const urlParams = new URLSearchParams(window.location.search);
  const docCode = urlParams.get("codeDocument");

  if (!docCode) return;

  // 3. Find the matching document
  const matchedDoc = documentRecords.find(
    (record) => record.documentCode === docCode
  );
  if (!matchedDoc) return;

  let sectorNameDisplay = "";
  switch (matchedDoc.sector) {
    case "health-office":
      sectorNameDisplay = "Health Office";
      break;
    case "civil-registrar-office":
      sectorNameDisplay = "Civil Registrar Office";
      break;
    case "gen-service-office":
      sectorNameDisplay = "General Services Office";
      break;
    case "agricultural-office":
      sectorNameDisplay = "Agricultural Office";
      break;
    case "accounting-office":
      sectorNameDisplay = "Accounting Office";
      break;
  }

  // 4. Insert data into HTML elements using element IDs
  document.getElementById("docCode").textContent =
    matchedDoc.documentCode || "-";
  document.getElementById("fullName").textContent =
    `${matchedDoc.lastName || ""}, ${matchedDoc.firstName || ""} ${
      matchedDoc.middleName || ""
    } ${matchedDoc.suffixName || ""}`.trim() || "-";
  document.getElementById("age").textContent = matchedDoc.age || "-";
  document.getElementById("sex").textContent = matchedDoc.sex || "-";
  document.getElementById("address").textContent = matchedDoc.address || "-";
  document.getElementById("documentDate").textContent =
    matchedDoc.documentDate || "-";
  document.getElementById("documentDateValidation").textContent =
    matchedDoc.documentDateValidation || "-";
  document.getElementById("sector").textContent = sectorNameDisplay || "-";
  document.getElementById("documentStatus").textContent =
    matchedDoc.documentStatus || "-";

  // Check and load process log (without returning early)
  const processLogs = JSON.parse(localStorage.getItem("processLogs")) || [];
  const matchedLog = processLogs.find(
    (record) => record.documentCode === docCode
  );

  if (matchedLog) {
    document.getElementById("referenceNumValidRemark").textContent =
      matchedLog.referenceNumValid || "Not yet processed!";
    document.getElementById("officerNameRemark").textContent =
      matchedLog.officerName || "Not yet processed!";
    document.getElementById("documentRemarksRemark").textContent =
      matchedLog.documentRemarks || "Not yet processed!";
    document.getElementById("remarkDescriptionRemark").textContent =
      matchedLog.remarkDescription || "Not yet processed!";
  }

  // QR Code Generation
  const documentQR = new QRCodeStyling({
    width: 200,
    height: 200,
    type: "png",
    shape: "circle",
    data: `${window.location.origin}/document/viewDocument.html?codeDocument=${docCode}`,
    image: "../assets/images/Santa_Elena_Camarines_Norte.png",
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
  documentQR.append(document.getElementById("qr-box"));

  function generateReferenceNumber(sector) {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, "0");
    const day = String(currentDate.getDate()).padStart(2, "0");

    let depCode = "";
    switch (sector) {
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

    let endCode = Math.floor(Math.random() * 99999999 + 1);
    return `${depCode}-${year}${month}${day}-${endCode}`;
  }

  const referenceNumValid = generateReferenceNumber(matchedDoc.sector);
  const name = localStorage.getItem("displayName");

  document.getElementById("referenceNumValid").value = referenceNumValid;
  document.getElementById("officerName").value = name;

  const processLogForm = document.getElementById("processLog");
  document
    .getElementById("processRequest")
    .addEventListener("click", handleProcessRequest);

  function handleProcessRequest() {
    const formData = new FormData(processLogForm);

    const remarkDescription = formData.get("remarkDescription").trim() || "N/A";
    const documentCode = new URLSearchParams(window.location.search).get(
      "codeDocument"
    );

    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, "0");
    const day = String(currentDate.getDate()).padStart(2, "0");

    const processDetails = {
      referenceNumValid: referenceNumValid,
      officerName: name,
      documentStatus: formData.get("setStatus"),
      documentRemarks: formData.get("documentRemarks"),
      documentDateValidation: `${year}-${month}-${day}`,
      remarkDescription: remarkDescription,
      documentCode: documentCode,
    };

    // Update document status
    const documentRecords =
      JSON.parse(localStorage.getItem("documentRecords")) || [];
    const matchedDocIndex = documentRecords.findIndex(
      (doc) => doc.documentCode === documentCode
    );
    if (matchedDocIndex !== -1) {
      documentRecords[matchedDocIndex].documentStatus =
        processDetails.documentStatus;
      documentRecords[
        matchedDocIndex
      ].documentDateValidation = `${year}-${month}-${day}`;
      localStorage.setItem("documentRecords", JSON.stringify(documentRecords));
    }

    // Update logs
    let processLogs = JSON.parse(localStorage.getItem("processLogs")) || [];
    processLogs = processLogs.filter(
      (log) => log.documentCode !== documentCode
    );
    processLogs.push(processDetails);
    localStorage.setItem("processLogs", JSON.stringify(processLogs));

    // Reset and redirect
    processLogForm.reset();
    closePrompt();
    window.location.href = `../../../../../document/tracking.html?codeDocument=${documentCode}`;
  }
});

function closePrompt() {
  const processDocument = document.getElementById("processFormBox");
  processDocument.style.display = "none";

  const promptCancel = document.getElementById("cancelFormBox");
  promptCancel.style.display = "none";

  const remarkView = document.getElementById("remarkView");
  remarkView.style.display = "none";
}

document
  .getElementById("cancelDocument")
  .addEventListener("click", popTerminateDocument);
function popTerminateDocument() {
  const promptCancel = document.getElementById("cancelFormBox");
  promptCancel.style.display = "flex";
}

document
  .getElementById("processDocument")
  .addEventListener("click", popProcessForm);
function popProcessForm() {
  const processDocument = document.getElementById("processFormBox");
  processDocument.style.display = "flex";
}

document.getElementById("viewRemarks").addEventListener("click", viewRemarks);
function viewRemarks() {
  const remarkView = document.getElementById("remarkView");
  remarkView.style.display = "flex";
}

document
  .getElementById("deleteRecord")
  .addEventListener("click", deleteDocument);
function deleteDocument() {
  const urlParams = new URLSearchParams(window.location.search);
  const docCode = urlParams.get("codeDocument");
  if (!docCode) return;

  const documentRecords =
    JSON.parse(localStorage.getItem("documentRecords")) || [];

  const itemIndex = documentRecords.findIndex(
    (record) => record.documentCode === docCode
  );
  if (itemIndex === -1) return;

  documentRecords.splice(itemIndex, 1);
  localStorage.setItem("documentRecords", JSON.stringify(documentRecords));

  window.location.href = "../../../../../document/repository.html";
}
