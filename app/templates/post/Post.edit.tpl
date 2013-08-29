{extends file='layouts/Main.layout.tpl'}

{block name='head'}

{/block}

{block name='body'}
    {if $post}
        <div class="span12">

            <form action="/post/post.check_edit?view=json" method="POST">
                <fieldset>
                    <input type="hidden" name="post_id" value="{(string)$post._id}"/>
                    <legend>Заголовок</legend>
                    <input class="span12" type="text" name="title" value="{$post.title}"/>

                    <legend>Текст <span class="label label-important">HTML</span></legend>
                    <textarea class="span12" name="text" id="" cols="30" rows="10">
                        {$post.text}
                    </textarea>

                    <p>
                        <button class="btn btn-success ajax" type="submit"><i class="icon-plus"></i> Запостить</button>
                    </p>
                </fieldset>
            </form>
        </div>
        <script type="text/javascript">
            var currErrorCallback = function (errors) {
                showErrors(errors);
            }

            var currSuccessCallback = function (data) {
                redirect();
            }
        </script>
    {else}
        <div class="alert alert-error">
            Данного поста в базе не найдено.
        </div>
    {/if}

{/block}
{block name="add_js"}
    <script type="text/javascript" src="/js/jquery.form.min.js"></script>
{/block}
