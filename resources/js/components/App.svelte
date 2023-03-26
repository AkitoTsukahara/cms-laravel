<div>
  <h1 class="text-center">タイトルです</h1>
</div>

<script>
  import PostList from './post/PostList.svelte';

  let postList;
</script>
<div>
  <h1>Tweet タイトルです（Svelte側です！）</h1>
  <div class="grid grid-cols-2 gap-7">
    <div>
      <PostList bind:this={postList}/>
    </div>
  </div>
</div>
