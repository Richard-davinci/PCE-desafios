import './bootstrap';

document.querySelectorAll('[id^="togglePass"]').forEach(btn => {
  const input = document.querySelector(`#${btn.id.replace('toggle', '')}`);
  if (input) {
    btn.addEventListener('click', () => {
      const isPassword = input.type === 'password';
      input.type = isPassword ? 'text' : 'password';
      btn.innerHTML = isPassword
        ? '<i class="bi bi-eye-slash"></i>'
        : '<i class="bi bi-eye"></i>';
    });
  }
});

