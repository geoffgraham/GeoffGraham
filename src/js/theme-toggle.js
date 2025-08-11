document.addEventListener('DOMContentLoaded', () => {
  console.log('Theme toggle script loaded');
  const toggleButton = document.querySelector('[data-theme-toggle]');
  console.log('Toggle button found:', toggleButton);
  
  if (toggleButton) {
    toggleButton.addEventListener('click', () => {
      console.log('Toggle button clicked');
      const html = document.documentElement;
      const currentTheme = html.getAttribute('data-theme');
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      console.log('Switching from', currentTheme, 'to', newTheme);
      html.setAttribute('data-theme', newTheme);
      localStorage.setItem('theme', newTheme);
    });
  }
  
  // Check for saved theme on load
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme) {
    document.documentElement.setAttribute('data-theme', savedTheme);
  }
});
