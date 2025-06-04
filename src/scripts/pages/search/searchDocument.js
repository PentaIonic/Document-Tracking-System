function searchDocument(codeDocument) {
  const params = new URLSearchParams({ codeDocument });
  window.location.href = `../../search/results.html?${params.toString()}`;
}

function clickSearch() {
  const documentID = document.getElementById("documentID");
  let searchKey = documentID.value;
  searchDocument(searchKey);
}
