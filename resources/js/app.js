import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
   const lightSwitches = document.querySelectorAll('.light-switch');

   if (lightSwitches.length === 0) return;

   const setDarkMode = (checked) => {
      document.documentElement.classList.add('transition-none');
      document.documentElement.classList.toggle('dark', checked);
      document.querySelector('html').style.colorScheme = checked ? 'dark' : 'light';
      localStorage.setItem('dark-mode', checked);
      document.dispatchEvent(new CustomEvent('darkMode', { detail: { mode: checked ? 'on' : 'off' } }));
      setTimeout(() => {
         document.documentElement.classList.remove('transition-none');
      }, 1);
   };

   lightSwitches.forEach((lightSwitch, i) => {
      if (localStorage.getItem('dark-mode') === 'true') {
         lightSwitch.checked = true;
      }

      lightSwitch.addEventListener('change', () => {
         const { checked } = lightSwitch;

         lightSwitches.forEach((el, n) => {
            if (n !== i) {
               el.checked = checked;
            }
         });

         setDarkMode(checked);
      });
   });
});