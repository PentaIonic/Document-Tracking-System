document.addEventListener("DOMContentLoaded", () => {
  // QR Code Generation
  // Get codeDocument from PHP $_GET via inline script
  const codeDocument = document.getElementById("qr-box").dataset.codeDocument;

  const documentQR = new QRCodeStyling({
    width: 200,
    height: 200,
    type: "png",
    shape: "circle",
    data: `${window.location.origin}/document/viewDocument.html?codeDocument=${codeDocument}`,
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
});
