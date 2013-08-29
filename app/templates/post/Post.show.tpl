{extends file='layouts/Main.layout.tpl'}

{block name='head'}

{/block}

{block name='body'}
    {if $post}
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
    {else}
        <div class="alert alert-error">
            Данного поста в базе не найдено.
        </div>
    {/if}

{/block}
{block name="add_js"}
    <script type="text/javascript" src="/js/jquery.form.min.js"></script>
{/block}
