document.addEventListener("DOMContentLoaded", () => {
  const documentRecords =
    JSON.parse(localStorage.getItem("documentRecords")) || [];
  const tableBody = document.querySelector("#documentDatabase tbody");
  const searchInput = document.querySelector("#searchDocument");

  function renderTable(filteredRecords) {
    tableBody.innerHTML = "";
    if (filteredRecords.length === 0) {
      const noDataRow = document.createElement("tr");
      noDataRow.innerHTML = `<td colspan="3" style="text-align:center;" class="noDataRow"><span>No Data Available</span></td>`;
      tableBody.appendChild(noDataRow);
    } else {
      filteredRecords.forEach((entry, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${index + 1}</td>
          <td>${entry.documentCode}</td>
          <td>${entry.documentStatus}</td>`;
        tableBody.appendChild(row);
      });
    }
  }

  // Initial table load
  renderTable(documentRecords);

  // Search filter
  searchInput.addEventListener("input", () => {
    const searchTerm = searchInput.value.trim();
    const filtered = documentRecords.filter(
      (entry) =>
      entry.documentCode &&
      entry.documentCode.toLowerCase().includes(searchTerm.toLowerCase())
    );
    renderTable(filtered);
  });
});

function trackDocumentInfo(codeDocument) {
  const params = new URLSearchParams({ codeDocument });
  window.location.href = `./results.html?${params.toString()}`;
}

function clickDocumentView() {
  const documentID = document.getElementById("searchDocument");
  let searchKey = documentID.value;
  searchDocument(searchKey);
}
