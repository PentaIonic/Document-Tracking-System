document.addEventListener("DOMContentLoaded", () => {
  const documentRecords =
    JSON.parse(localStorage.getItem("documentRecords")) || [];
  const tableBody = document.querySelector("#documentDatabase tbody");
  const searchInput = document.querySelector("#searchDocument");
  const sortSelect = document.querySelector("#sortCriteria");

  function extractDocumentID(code) {
    const parts = code.split("-");
    return parseInt(parts[2]) || 0;
  }

  function extractDepartment(code) {
    return code.split("-")[0] || "";
  }

  function getStatusOrder(status) {
    const order = { Pending: 1, Approved: 2, Rejected: 3 };
    return order[status] || 99; // default to bottom if unknown
  }

  function sortRecords(records, criterion) {
    const sorted = [...records];
    switch (criterion) {
      case "documentID":
        sorted.sort(
          (a, b) =>
            extractDocumentID(a.documentCode) -
            extractDocumentID(b.documentCode)
        );
        break;
      case "department":
        sorted.sort((a, b) =>
          extractDepartment(a.sector).localeCompare(extractDepartment(b.sector))
        );
        break;
      case "status":
        sorted.sort(
          (a, b) =>
            getStatusOrder(a.documentStatus) - getStatusOrder(b.documentStatus)
        );
        break;
    }
    return sorted;
  }

  function renderTable(filteredRecords) {
    tableBody.innerHTML = "";
    if (filteredRecords.length === 0) {
      const noDataRow = document.createElement("tr");
      noDataRow.innerHTML = `<td colspan="5" style="text-align:center;" class="noDataRow"><span>No Data Available</span></td>`;
      tableBody.appendChild(noDataRow);
    } else {
      filteredRecords.forEach((entry, index) => {
        const row = document.createElement("tr");

        let deptName = "";
        switch (entry.sector) {
          case "health-office":
            deptName = "Health Office";
            break;
          case "civil-registrar-office":
            deptName = "Civil Registrar Office";
            break;
          case "gen-service-office":
            deptName = "General Services Office";
            break;
          case "agricultural-office":
            deptName = "Agricultural Office";
            break;
          case "accounting-office":
            deptName = "Accounting Office";
            break;
        }

        row.innerHTML = `
          <td>${index + 1}</td>
          <td>${entry.documentCode}</td>
          <td>${deptName}</td>
          <td>${entry.documentStatus}</td>
          <td><input type="button" name="viewDocument" value="View" onclick="clickViewDocument('${
            entry.documentCode
          }')"/></td>`;
        tableBody.appendChild(row);
      });
    }
  }

  function updateTable() {
    const searchTerm = searchInput.value.trim().toLowerCase();
    const sortValue = sortSelect.value;

    let filtered = documentRecords.filter(
      (entry) =>
        entry.documentCode &&
        entry.documentCode.toLowerCase().includes(searchTerm)
    );

    filtered = sortRecords(filtered, sortValue);
    renderTable(filtered);
  }

  // Initial table load
  updateTable();

  searchInput.addEventListener("input", updateTable);
  sortSelect.addEventListener("change", updateTable);
});

function trackDocumentInfo(codeDocument) {
  const params = new URLSearchParams({ codeDocument });
  window.location.href = `../../document/tracking.html?${params.toString()}`;
}

function clickViewDocument() {
  const documentCode = event.target.closest("tr").children[1].textContent;
  trackDocumentInfo(documentCode);
}
