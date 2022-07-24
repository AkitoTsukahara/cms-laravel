<script>
  import TweetList from './tweet/TweetList.svelte';
  import Create from './tweet/Create.svelte';

  let tweetList;
  let params = {
    id: '',
    title: '',
    content: '',
  };

  const onEdit = e => {

    params = e.detail.tweet;

  };
</script>
<div>
    <h1 class="text-3xl mb-4">Tweet タイトルです</h1>
    <div class="grid grid-cols-2 gap-7">
        <div>
            <TweetList bind:this={tweetList}/>
        </div>
        <div>
            <Create params="{params}" on:article-saved={tweetList.getArticles}></Create>
        </div>
    </div>
</div>
