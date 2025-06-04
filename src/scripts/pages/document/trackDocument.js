document.addEventListener("DOMContentLoaded", () => {
  // 1. Get stored records
  const documentRecords = JSON.parse(localStorage.getItem("documentRecords")) || [];

  // 2. Get ?docCode=XYZ from the URL
  const urlParams = new URLSearchParams(window.location.search);
  const docCode = urlParams.get("codeDocument");

  if (!docCode) return;

  // 3. Find the matching document
  const matchedDoc = documentRecords.find(record => record.documentCode === docCode);
  if (!matchedDoc) return;

  // 4. Insert data into HTML elements using element IDs
  document.getElementById("docCode").textContent = matchedDoc.documentCode || "-";
  document.getElementById("fullName").textContent = 
    `${matchedDoc.lastName || ""}, ${matchedDoc.firstName || ""} ${matchedDoc.middleName || ""}`.trim() || "-";
  document.getElementById("age").textContent = matchedDoc.age || "-";
  document.getElementById("sex").textContent = matchedDoc.sex || "-";
  document.getElementById("address").textContent = matchedDoc.address || "-";
  document.getElementById("documentDate").textContent = matchedDoc.documentDate || "-";
  document.getElementById("sector").textContent = matchedDoc.sector || "-";
  document.getElementById("documentStatus").textContent = matchedDoc.status || "-";
});
