<script>
  import TweetList from './tweet/TweetList.svelte';
  import Create from './tweet/Create.svelte';

  let tweetList;
  let params = {
    id: '',
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
            <TweetList bind:this={tweetList} on:tweet-edit={onEdit}/>
        </div>
        <div>
            <Create params="{params}" on:tweet-saved={tweetList.getTweets}></Create>
        </div>
    </div>
</div>
