{extends file='layouts/Main.layout.tpl'}

{block name='head'}

{/block}

{block name='body'}
   <a class="btn btn-success" href="/schedule/task.add_task"><i class="icon-plus"></i> Добавить задачу</a> <a class="btn btn-warning send_act" href="/schedule/task.update_schedule&view=raw"><i class="icon-refresh"></i> Обновить планировщик</a>
   <table class="table" style="margin-top: 20px">
      <thead>
      <tr>
         <td>Id</td>
         <td>Название</td>
         <td>Статус</td>
         <td>Прогресс</td>
         <td>Действия</td>
      </tr>
      </thead>
      <tbody>
      {foreach $tasks as $task}
         <tr>
            <td>{$task._id}</td>
            <td>{$task.name}<br>
                Параметры: {json_encode($task.params)}</td>
            <td>
               {if $task.status==1}
                  <span style="color: darkslategray">Ожидание</span>
               {elseif $task.status==2}
                  <span style="color: darkorchid">В процессе</span>
               {elseif $task.status==3}
                  <span style="color: green">Закончена</span>
               {elseif $task.status==4}
                  <span style="color: indianred">Прервана</span>
               {elseif $task.status==5}
                  <span style="color: red">Прервана с ошибками</span>
                  <br/>
                  {json_encode($task.errors)}
               {/if}
            </td>
            <td>{$task.progress}</td>
            <td>
               <a class="btn btn-danger send_act" href="/schedule/task.abort_task?taskId={$task._id}&view=json"><i class="icon-remove"></i> Удалить</a>
            </td>
         </tr>
      {/foreach}
      </tbody>

   </table>
{/block}
{block name="add_js"}

{/block}