function redirectDepartmentCode(department) {
  const params = new URLSearchParams({ department });
  const basePath = window.location.origin + "/Document-Tracking-System";
  window.location.href = `${basePath}/document/register/index.php?${params.toString()}`;
}
