/* Since displaying logs and it is not much needed in other pages. In this implementation, it is clustered into a single file if the page is being loaded will be executed along. */
document.addEventListener("DOMContentLoaded", () => {
  const documentRecords =
    JSON.parse(localStorage.getItem("documentRecords")) || [];
  const processLogs = JSON.parse(localStorage.getItem("processLogs")) || [];
  const tableLog = document.querySelector("#showLogs tbody");

  tableLog.innerHTML = "";

  if (documentRecords.length === 0) {
    const noDataRow = document.createElement("tr");
    noDataRow.innerHTML = `<td colspan="5" style="text-align:center;" class="noDataRow"><span>No Data Available</span></td>`;
    tableLog.appendChild(noDataRow);
  }

  let hoCount = 0;
  let croCount = 0;
  let gsoCount = 0;
  let agoCount = 0;
  let acoCount = 0;

  documentRecords.forEach((record) => {
    const log = processLogs.find((l) => l.documentCode === record.documentCode);

    const handled = log?.officerName || "Not yet processed";
    const dateProcessed = log?.documentDateValidation || "Not yet processed";

    const row = document.createElement("tr");
    row.innerHTML = `
    <td>${
      record.lastName +
        ", ".concat(record.firstName) +
        " ".concat(record.middleName) +
        " ".concat(record.suffixName) || ""
    }</td>
    <td>${record.documentType || ""}</td>
    <td>${record.documentStatus || ""}</td>
    <td>${handled}</td>
    <td>${dateProcessed}</td>
  `;
    tableLog.appendChild(row);

    switch (record.sector) {
      case "health-office":
        hoCount++;
        break;
      case "civil-registrar-office":
        croCount++;
        break;
      case "gen-service-office":
        gsoCount++;
        break;
      case "agricultural-office":
        agoCount++;
        break;
      case "accounting-office":
        acoCount++;
        break;
    }
  });

  document.getElementById("hoRecordValue").textContent = hoCount || "0";
  document.getElementById("croRecordValue").textContent = croCount || "0";
  document.getElementById("gsoRecordValue").textContent = gsoCount || "0";
  document.getElementById("agoRecordValue").textContent = agoCount || "0";
  document.getElementById("acoRecordValue").textContent = acoCount || "0";

  let displayName = localStorage.getItem("displayName");
  try {
    displayName = JSON.parse(displayName);
  } catch (e) {
    console.log(e);
  }
  document.getElementById("dashboardLoggedName").textContent =
    displayName || "Placeholder";
});
