{extends file='layouts/Main.layout.tpl'}

{block name='head'}

{/block}

{block name='body'}
    <div class="span12">
    {foreach $posts as $post}
        <div class="row">
            <div class="row">
                <h3><a href="/post/post.show?post_id={$post._id}">{$post.title}</a></h3>
            </div>
            <div class="row">
                <p>
                    {$post.text}
                </p>
            </div>
        </div>
    {/foreach}
        {$curPage = $smarty.get.page}
        <div class="pagination">
            <ul>
                {if $curPage>1}
                    <li><a href="/?page={$curPage-1}">Prev</a></li>
                {/if}
                {for $showp = 1 to $pages}
                    <li><a href="/?page={$showp}">{$showp}</a></li>
                {/for}
                {if $curPage<$pages}
                    <li><a href="/?page={$curPage+1}">Next</a></li>
                {/if}
            </ul>
        </div>
    </div>
{/block}
