{extends file='layouts/Main.layout.tpl'}

{block name='head'}

{/block}

{block name='body'}
    <form action="/user/user.check_login?view=json" method="POST">
        <fieldset>
        <label for="nick">Nick: </label>
        <input type="text" name="nick"/><br/>

        <label for="pass">Пароль: </label>
        <input type="password" name="pass"/>

            <p>
                <button type="submit" class="btn ajax"><i class="icon-arrow-right"></i> Войти</button>
            </p>

        </fieldset>
    </form>
    <script type="text/javascript">
        var currErrorCallback = function (errors) {
            showErrors(errors);
        }

        var currSuccessCallback = function () {
            redirect('/user/user.show');
        }
    </script>
{/block}
{block name="add_js"}
    <script type="text/javascript" src="/js/jquery.form.min.js"></script>

{/block}
