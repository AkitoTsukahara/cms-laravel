require('./bootstrap');

import Post from './components/Post.svelte';

new Post({
  target: document.querySelector('#post'),
});
