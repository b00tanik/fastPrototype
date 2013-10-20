{extends file='layouts/Main.layout.tpl'}

{block name='head'}

{/block}

{block name='body' prepend}
   <div class="span12">
      <h4>Добавить новый запрос</h4>
      <form action="/food/adminfood.check_edit?view=json" method="POST">
         <fieldset>
            <legend>Название</legend>
            <input class="span12" type="text" name="title"/>

            <legend>Тип</legend>
            <input class="span12" type="text" name="title"/>


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