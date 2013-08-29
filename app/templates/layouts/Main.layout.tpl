<!doctype html>
<html>
<head>
    <link rel="shortcut icon" href="/img/icons/favicon.ico" type="image/x-icon"/>

    <title>{block name=title}Padusers{/block}</title>
    <script src="/js/jquery.min.js" type="text/javascript"></script>
    <link href="/css/bootstrap.min.css" rel="stylesheet" media="all" />
    <link href="/css/main.css" rel="stylesheet" media="all" />
    {block name=head}{/block}
</head>
<body>
<html>
<head>

</head>
<body>
    <div class="container" style="padding-top: 10px">
        <div class="row">
            <div class="span12">
                <div class="span 4"><a href="/"><img src="/img/logo.png" /></a></div>
                <div class="span4 pull-right">
                    {if !Cookies::isSetted('token') }
                        <a href="/user/user.register" class="btn"><i class="icon-edit"></i> Регистрация</a>
                        <a href="/user/user.login" class="btn"><i class="icon-arrow-right"></i> Вход</a>
                    {else}

                        <a href="/user/user.show?uid={Cookies::get('login')}" class="btn"><i class="icon-user"></i> {Cookies::get('login')}</a>
                        <hr>
                        <a href="/user/user.logout?view=raw" class="btn"><i class="icon-eject"></i> Выйти</a>
                    {/if}
                </div>

            </div>
        </div>
        {if Cookies::isSetted('token') }
             <div class="row"> <a href="/post/post.write" class="btn btn-inverse inline"><i class="icon-plus icon-white"></i> Написать</a></div>
        {/if}
        <div class="row">
{block name=body}{/block}
        </div>
    </div>

    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    {block name=add_js}{/block}
    <script type="text/javascript" src="/js/utils.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    {block name=footer}{/block}
</body>
</html>