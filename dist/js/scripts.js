document.addEventListener('DOMContentLoaded', () => {
  console.log('Theme toggle script loaded');
  const toggleButton = document.querySelector('[data-theme-toggle]');
  console.log('Toggle button found:', toggleButton);
  
  if (toggleButton) {
    toggleButton.addEventListener('click', (event) => {
      console.log('Toggle button clicked');
      const html = document.documentElement;
      const currentTheme = html.getAttribute('data-theme');
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      console.log('Switching from', currentTheme, 'to', newTheme);
      
      // Use view transition if supported
      if (document.startViewTransition) {
        const x = event.clientX;
        const y = event.clientY;
        const endRadius = Math.hypot(
          Math.max(x, innerWidth - x),
          Math.max(y, innerHeight - y),
        );
        
        document.documentElement.style.setProperty('--x', x + 'px');
        document.documentElement.style.setProperty('--y', y + 'px');
        document.documentElement.style.setProperty('--r', endRadius + 'px');
        
        document.startViewTransition(() => {
          document.documentElement.style.viewTransitionName = 'theme-toggle';
          html.setAttribute('data-theme', newTheme);
        }).finished.finally(() => {
          document.documentElement.style.viewTransitionName = '';
        });
      } else {
        html.setAttribute('data-theme', newTheme);
      }
      
      localStorage.setItem('theme', newTheme);
    });
  }
  
  // Check for saved theme on load
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme) {
    document.documentElement.setAttribute('data-theme', savedTheme);
  }
});
