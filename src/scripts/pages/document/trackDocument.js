document.addEventListener("DOMContentLoaded", () => {
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
  const urlParams = new URLSearchParams(window.location.search);
  const docCode = urlParams.get("code");

  if (!docCode) return;

  // QR Code Generation
  const qrBox = document.getElementById("qr-box");
  if (!qrBox) {
    console.error("QR Box not found");
    return;
  }

  const documentQR = new QRCodeStyling({
    width: 200,
    height: 200,
    type: "png",
    data: qrData,
    image: "../../assets/images/Santa_Elena_Camarines_Norte.png",
    dotsOptions: {
      color: "var(--accent-color)", // fallback color
      type: "classy-rounded",
    },
    backgroundOptions: {
      color: "var(--background-color)", // fallback background
    },
    imageOptions: {
      margin: 10,
    },
  });

  documentQR.append(qrBox);
});

function closePrompt() {
  const processDocument = document.getElementById("processFormBox");
  processDocument.style.display = "none";

  const promptCancel = document.getElementById("cancelFormBox");
  promptCancel.style.display = "none";

  const remarkView = document.getElementById("remarkView");
  remarkView.style.display = "none";
}
