{extends file='layouts/Main.layout.tpl'}

{block name='head'}

{/block}

{block name='body' append}

   {$curPage = $smarty.get.page}
   <div class="pagination">
      <ul>
         {if $curPage>1}
            <li><a href="/{$smarty.get.q}?page={$curPage-1}">Prev</a></li>
         {/if}
         {for $showp = 1 to $pages}
            <li><a href="/{$smarty.get.q}?page={$showp}">{$showp}</a></li>
         {/for}
         {if $curPage<$pages}
            <li><a href="/{$smarty.get.q}?page={$curPage+1}">Next</a></li>
         {/if}
      </ul>
   </div>
{/block}

