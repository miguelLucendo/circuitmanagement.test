/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

// Font awesome
import '@fortawesome/fontawesome-free/css/all.min.css';

// Dark mode toggle
// darkModeToggle();


const darkModeToggle = () => {
  if (localStorage.cmTheme === 'dark' || (!('cmTheme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark')
  } else {
    document.documentElement.classList.remove('dark')
  }

  const toggle = document.querySelector('#darkModeCheckbox');
  toggle.addEventListener('change', () => {
    if (toggle.checked) {
      document.documentElement.classList.add('dark')
      localStorage.cmTheme = 'dark';
    } else {
      document.documentElement.classList.remove('dark')
      localStorage.cmTheme = 'light';
    }
});
  // Whenever the user explicitly chooses light mode

  // Whenever the user explicitly chooses dark mode
  // localStorage.cmTtheme = 'dark'


}
