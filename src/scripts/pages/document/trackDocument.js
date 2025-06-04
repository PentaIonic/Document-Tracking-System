document.addEventListener("DOMContentLoaded", () => {
  const documentRecords =
    JSON.parse(localStorage.getItem("documentRecords")) || [];
  const urlParams = new URLSearchParams(window.location.search);
  const docCode = urlParams.get("docCode");

  if (!docCode) return;

  const selected = documentRecords.find((d) => d.documentCode === docCode);

  if (!selected) return;

  document.getElementById("docCode").textContent = selected.documentCode;
  document.getElementById("fullName").textContent =
    selected.lastName + selected.firstName + selected.middleName || "-";
  document.getElementById("age").textContent = selected.age || "-";
  document.getElementById("sex").textContent = selected.sex || "-";
  document.getElementById("address").textContent = selected.address || "-";
  document.getElementById("documentDate").textContent =
    selected.documentDate || "-";
  document.getElementById("sector").textContent = selected.sector || "-";
  document.getElementById("documentStatus").textContent =
    selected.status || "-";
});
