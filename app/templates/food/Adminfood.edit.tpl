{extends file='layouts/Main.layout.tpl'}

{block name='head'}

{/block}

{block name='body' prepend}
   {$isEdit=isset($smarty.get.id)}
   <div class="span12">
      <form action="/food/adminfood.check_edit?view=json" method="POST">
         <fieldset>
            <legend>Добавить новый запрос</legend>

            <label>Название</label>
            <input class="span12" type="text" name="title"
                  {if $isEdit}value="{$food.title}"{/if}/>

            <label>Тип</label>
            <select name="type" id="type">
               {$localizedTypes = FoodModel::getLocalizedTypes()}
               {foreach FoodModel::getTypes() as $key=>$type}
                  <option value="{$type}"
                          {if $isEdit && $food.type==$type}selected="selected" {/if}
                        >{$localizedTypes.$key}</option>
                  {$type}
               {/foreach}
            </select>
            <label>Описание (не более 300 символов)</label>
            <textarea class="span12" name="text" id="" cols="30" rows="10">
               {if $isEdit}{$food.description}{/if}
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
          redirect('/food/adminfood.edit?id='+data.edit_id);
      }
   </script>
{/block}
{block name="add_js"}
   <script type="text/javascript" src="/js/jquery.form.min.js"></script>
{/block}