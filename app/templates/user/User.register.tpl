{extends file='layouts/Main.layout.tpl'}

{block name='head'}

{/block}

{block name='body'}
    <form action="/user/user.check_register?view=json" method="POST">
        <fieldset>

            <label for="nick">Ник: </label>
            <input type="text" name="nick"/><br/>

            <label for="pass">Пароль: </label>
            <input type="password" name="pass"/><br/>

            <label for="pass_confirm">Подтверждение пароля: </label>
            <input type="password" name="pass_confirm"/>

            <p>
                <button type="submit" class="btn ajax"><i class="icon-arrow-right"></i> Зарегистрироваться</button>
            </p>
        </fieldset>
    </form>
    <script type="text/javascript">
        var currErrorCallback = function (errors) {
            showErrors(errors);
        }

        var currSuccessCallback = function () {
            redirect('/user/user.login');
        }
    </script>
{/block}
{block name="add_js"}
    <script type="text/javascript" src="/js/jquery.form.min.js"></script>
{/block}
