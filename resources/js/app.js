require('./bootstrap');

import App from './components/App.svelte';

new App({
  target: document.querySelector('#app'),
});
