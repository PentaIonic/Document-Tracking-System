function redirectDepartmentCode(department) {
  const params = new URLSearchParams({ department });
  window.location.href = `../../document/register.html?${params.toString()}`;
}
