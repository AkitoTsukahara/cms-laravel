<script>
  import TweetList from './tweet/TweetList.svelte';

  let tweetList;
</script>
<div>
    <h1>Tweet タイトルです</h1>
    <div class="grid grid-cols-2 gap-7">
        <div>
            <TweetList bind:this={tweetList}/>
        </div>
    </div>
</div>
