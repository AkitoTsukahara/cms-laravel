<script>
  import { createEventDispatcher, onMount } from 'svelte';

  const dispatch = createEventDispatcher();
  let posts = [];
  let page = 1;
  let hasPrevPage = false;
  let hasNextPage = false;

  export const getPosts = () => {
    const url = `/posts/list/?page=${page}`;
    axios.get(url).then(response => {
      posts = response.data.data;
      hasPrevPage = response.data.prev_page_url !== null;
      hasNextPage = response.data.next_page_url !== null;
    });
    console.log(posts);
  };
  const onMovePage = mode => {
    if (mode === 'next') {
      page++;
    } else if (mode === 'prev') {
      page--;
    }
    getPosts();
  };
  onMount(() => {
    getPosts();
    console.dir(posts);
  });
</script>

<div>
    <table class="w-full text-sm mb-5">
        <thead>
        <tr>
            <th class="border p-2">本文</th>
            <th class="border p-2">操作</th>
        </tr>
        </thead>
        <tbody>
        {#each posts as post}
            <tr>
                <td class="border px-2 py-1">{post.content}</td>
                <td class="border px-2 py-1 text-right">
                    <button
                            type="button"
                            class="bg-yellow-500 text-yellow-50 rounded p-2 text-xs">
                        変更
                    </button>
                    <button
                            type="button"
                            class="bg-red-600 text-red-50 rounded p-2 text-xs">
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
