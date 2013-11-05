{extends file='layouts/Main.layout.tpl'}

{block name='head'}

{/block}

{block name='body'}
   <div class="span5">
      <h4>Добавить задачу</h4>

      <form action="/schedule/Task.check_add_task?view=json" method="POST">
         <fieldset>
            <label for="taskSelect">Название</label>
            <select name="taskName" id="taskSelect">
               {foreach $allowedTasks as $task}
                  <option value="{$task}">{$task}</option>
               {/foreach}
            </select>

            <div id="taskParams">

            </div>
            <p>
               <button class="btn btn-success ajax" type="submit"><i class="icon-plus"></i> Записать</button>
            </p>
         </fieldset>
      </form>
      <script type="text/javascript">
         var currErrorCallback = function (errors) {
            showErrors(errors);
         };

         var currSuccessCallback = function (data) {
            redirect();
         }
      </script>
   </div>
   <div class="span5">
      <h4>Ожидающие выполнения</h4>
      <table class="table">
         <thead>
         <tr>
            <td>ID</td>
            <td>Название</td>
            <td>Параметры</td>
         </tr></thead>
         <tbody>
         {foreach $waitTasks as $task}
            <tr>
               <td>{$task._id}</td>
               <td>{$task.name}</td>
               <td>{json_encode($task.params)}</td>
            </tr>
         {/foreach}
         </tbody>
      </table>
   </div>
{/block}
{block name="add_js"}
   <script type="text/javascript" src="/js/jquery.form.min.js"></script>
{/block}
{block name="footer"}
   <script>
      function refreshParams(){
         $('#taskParams').html('<img src="/img/loader.gif" alt="Загружаем..."/>');
         $.post('/schedule/Task.get_task_params?view=json',
               {
                  taskName:$('#taskSelect').val()
               }, function(data){
                  $('#taskParams').html(generateFormFields(data));
               })
      }
      refreshParams();
      $('#taskSelect').change(function(e){
         refreshParams();
      })
   </script>
{/block}