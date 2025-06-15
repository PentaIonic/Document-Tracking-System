// This function serves to redirect the user to results page with the value inputted in the search box.
function searchDocument(codeDocument) {
  const params = new URLSearchParams({ codeDocument });
  window.location.href = `./search/results.html?${params.toString()}`;
}

function searchDocumentUser(search) {
  const params = new URLSearchParams({ search });
  window.location.href = `./results.php?${params.toString()}`;
}

// If the user clicks or enters the search field, this function will be called.
function clickSearch() {
  const documentID = document.getElementById("documentID");
  let searchKey = documentID.value;
  searchDocument(searchKey);
}

function clickSearchUser() {
  const documentID = document.getElementById("documentID");
  let searchKey = documentID.value;
  searchDocumentUser(searchKey);
}