<script>
  import { createEventDispatcher, onMount } from 'svelte';

  const dispatch = createEventDispatcher();
  let tweets = [];
  let page = 1;
  let hasPrevPage = false;
  let hasNextPage = false;

  export const getTweets = () => {
    const url = `/tweets/list/?page=${page}`;
    axios.get(url).then(response => {
      tweets = response.data.data;
      hasPrevPage = response.data.prev_page_url !== null;
      hasNextPage = response.data.next_page_url !== null;
    });
  };
  const onEdit = tweet => {
    dispatch('tweet-edit', { tweet: tweet });
  };
  const onDelete = tweet => {
    if (confirm('削除します。よろしいですか？')) {
      const url = `/tweets/delete/${tweet.id}`;
      axios.post(url).then(response => {
        if (response.data.result === true) {
          getTweets();
        }
      });
    }
  };
  const onMovePage = mode => {
    if (mode === 'next') {
      page++;
    } else if (mode === 'prev') {
      page--;
    }
    getTweets();
  };
  onMount(() => {
    getTweets();
  });
</script>

<div>
    <table class="table-auto">
        <thead>
        <tr>
            <th class="px-4 py-2">本文</th>
            <th class="px-4 py-2">操作</th>
        </tr>
        </thead>
        <tbody>
        {#each tweets as tweet}
            <tr>
                <td class="border px-2 py-1">{tweet.content}</td>
                <td class="border px-2 py-1 text-right">
                    <button
                            type="button"
                            class="bg-yellow-500 text-yellow-50 rounded p-2 text-xs" on:click={onEdit(tweet)}>
                        変更
                    </button>
                    <button
                            type="button"
                            class="bg-red-600 text-red-50 rounded p-2 text-xs" on:click={onDelete(tweet)}>
                        削除
                    </button>
                </td>
            </tr>
        {/each}
        </tbody>
    </table>

    {#if hasPrevPage === true}
        <button
                type="button"
                class="bg-blue-500 text-blue-50 rounded p-2 text-xs" on:click={() => onMovePage('prev')}>
            前へ
        </button>
    {/if}
    {#if hasNextPage === true}
        <button
                type="button"
                class="bg-blue-500 text-blue-50 rounded p-2 text-xs" on:click={() => onMovePage('next')}>
            次へ
        </button>
    {/if}

</div>
