<script>

  import { createEventDispatcher } from 'svelte';

  const dispatch = createEventDispatcher();
  export let params = {
    id: '',
    content: '',
  };
  let resultMessage = '';
  let isModeCreate = false;
  let isModeEdit = false;

  // Vue で言うところの computed
  $: {
    isModeCreate = (params.id === '');
    isModeEdit = (params.id !== '');
  }

  const onSubmit = () => {

    if (confirm('送信します。よろしいですか？')) {

      let url = '';
      let additionalParams = {};

      if (isModeCreate) {
        url = '/tweets/create';
      } else if (isModeEdit) {
        url = `/tweets/${params.id}`;
        additionalParams = { _method: 'PUT' };
      }

      const data = Object.assign({}, params, additionalParams);
      axios.post(url, data).then(response => {
        if (response.data.result === true) {
          dispatch('tweet-saved');
          resultMessage = '保存が完了しました！';
          setTimeout(() => { // 3 秒後にメッセージをクリア
            resultMessage = '';
          }, 3000);
          params = {
            // id: '',
            content: '',
          };

        }

      });

    }

  };

</script>

<div>
    <div class="pb-4 text-sm">
        （ArticleInput）
    </div>
    <div>
        {#if resultMessage !== ''}
            <div class="text-green-700 p-3 bg-green-300 rounded mb-3">
                {resultMessage}
            </div>
        {/if}
    </div>
    <div class="mb-4">
        <label for="content">本文</label>
        <br>
        <textarea id="content" rows="7" class="border w-full p-1" bind:value="{params.content}"></textarea>
    </div>
    {#if isModeCreate}
        <button type="submit" class="bg-purple-700 text-purple-50 p-2 rounded" on:click={onSubmit}>登録する</button>
    {:else if isModeEdit}
        <button type="submit" class="bg-blue-700 text-blue-50 p-2 rounded" on:click={onSubmit}>変更する</button>
    {/if}
</div>
