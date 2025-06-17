function searchDocument(codeDocument) {
  const params = new URLSearchParams({ codeDocument });
  window.location.href = `./document/repository.html?${params.toString()}`;
}

function clickSearch() {
  const documentID = document.getElementById("searchDocument");
  let searchKey = documentID.value;
  searchDocument(searchKey);
}
