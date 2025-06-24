function closeForm() {
  const formBox = document.querySelector('.form-box');
  formBox.style.display = 'none';
}

window.addEventListener('load', () => {
  setTimeout(() => {
    document.querySelector('.form-box').style.display = 'block';
  }, 2000);
});
