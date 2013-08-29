{extends file='layouts/Main.layout.tpl'}

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

    </div>
{/block}
