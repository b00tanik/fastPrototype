<!doctype html>
<html>
<head>
    <link rel="shortcut icon" href="/img/icons/favicon.ico" type="image/x-icon"/>

    <title>{block name=title}Cookies{/block}</title>
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
<header>
      <div class="navbar navbar-fixed-top" >
         <div class="navbar-inner">
            <div class="container"  style="background-color: #004931">

               <a class="brand" href="/"><img src="/img/cookies.png" /></a>
               <div class="nav-collapse collapse">
                  <ul class="nav">
                     <li {if $smarty.get.q|strstr:"important"}class="active"{/if}>
                        <a href="/food/food.important">Важное</a>
                     </li>
                     <li {if $smarty.get.cat|strstr:"coockie"}class="active"{/if}>
                        <a  href="/food/food.get?cat=cookie">Печеньки</a>
                     </li>
                     <li  {if $smarty.get.cat|strstr:"drink"}class="active"{/if}>
                        <a href="/food/food.get?cat=drink">Напитки</a>
                     </li>
                     <li  {if $smarty.get.cat|strstr:"office"}class="active"{/if}>
                        <a href="/food/food.get?cat=office">Канцелярия</a>
                     </li>
                     <li {if $smarty.get.cat|strstr:"other"}class="active"{/if}>
                        <a href="/food/food.get?cat=other">Все остальное</a>
                     </li>
                     <li  {if $smarty.get.q|strstr:"user.top"}class="active"{/if}>
                        <a href="/user/user.top">Герои</a>
                     </li>
                  </ul>
               </div>
               <div class="span4 pull-right" style="padding-top: 10px; padding-right: 10px;">
                  {if !Cookies::isSetted('token') }
                     <a href="/user/user.register" class="btn"><i class="icon-edit"></i> Регистрация</a>
                     <a href="/user/user.login" class="btn"><i class="icon-arrow-right"></i> Вход</a>
                  {else}
                     <a href="/food/adminfood.edit" class="btn btn-success"><i class="icon-plus"></i> Добавить</a>
                     <a href="/user/user.show?uid={Cookies::get('login')}" class="btn"><i class="icon-user"></i> {Cookies::get('login')}</a>
                     <a href="/user/user.logout?view=raw" class="btn"><i class="icon-eject"></i> Выйти</a>
                  {/if}
               </div>
            </div>



         </div>





</header>

<div class="container" style="padding-top: 200px">

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