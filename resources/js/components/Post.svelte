<script>
  import PostList from './post/PostList.svelte';

  let postList;
</script>
<div>
    <h1>Post タイトルです（Svelte側です！）</h1>
    <div class="grid grid-cols-2 gap-7">
        <div>
            <PostList bind:this={postList}/>
        </div>
    </div>
</div>
