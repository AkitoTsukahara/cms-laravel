require('./bootstrap');

import Tweet from './components/Tweet.svelte';

new Tweet({
  target: document.querySelector('#tweet'),
});
