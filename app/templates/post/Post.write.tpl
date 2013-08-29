{extends file='layouts/Main.layout.tpl'}

{block name='head'}

{/block}

{block name='body'}
        <div class="span12">
            <form action="/post/post.check_write?view=json" method="POST">
                <fieldset>
                    <legend>Заголовок</legend>
                    <input class="span12" type="text" name="title"/>

                    <legend>Текст <span class="label label-important">HTML</span></legend>
                    <textarea class="span12" name="text" id="" cols="30" rows="10"></textarea>

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
           // redirect('/post/post.edit?post='+data.edit_id);
        }
    </script>
{/block}
{block name="add_js"}
    <script type="text/javascript" src="/js/jquery.form.min.js"></script>
{/block}
