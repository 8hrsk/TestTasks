const input = document.querySelector('.form-control');

input.addEventListener('input', function() {
  const label = this.nextElementSibling;
  if (this.value !== '') {
    label.classList.add('active');
    
  } else {
    label.classList.remove('active');
  }
});