<h1>Список задач</h1>


<table class="table">
  <thead>
    <tr>
      
      <th scope="col">Автор <a class="page-link" href="/?sorting_key=author&path=home/index&page=<?=$currPage?>&sorting_val=<?=$sortingVal?0:1?>"><?=$sortingVal?'По возрастанию':'По убыванию'?></a></th>
      <th scope="col">Email <a class="page-link" href="/?sorting_key=email&path=home/index&page=<?=$currPage?>&sorting_val=<?=$sortingVal?0:1?>"><?=$sortingVal?'По возрастанию':'По убыванию'?></a></th>
      <th scope="col">Текст</th>
      <th scope="col">Статус <a class="page-link" href="/?sorting_key=status&path=home/index&page=<?=$currPage?>&sorting_val=<?=$sortingVal?0:1?>"><?=$sortingVal?'По возрастанию':'По убыванию'?></a></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($jobs['data'] as $job):?>
  <tr>  
  
    <td><?=$job['author']?></td>
    <td><?=$job['email']?></td>
    <td><?=$job['text']?></td>
    <td><?=$job['status']>0?'Решена':'Не решена'?><?=abs($job['status'])==2?', редактировано админом':''?></td>
    <td><?php if($isAdmin):?>
        <a href="/?path=home/edit&id=<?=$job['id']?>">редактировать</a>
        <?php endif?>
    </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
  <?php if($jobs['totalPages']>1):?>
  <nav aria-label="Page navigation example">
  <ul class="pagination">
      
  <?php for($i=1;$i<=$jobs['totalPages'];$i++):?>
    <li class="page-item"><a class="page-link" href="/?path=home/index&page=<?=$i?>&sorting_key=<?=$sortingKey?>&sorting_val=<?=$sortingVal?>"><?=$i?></a></li>
    <?php endfor ?>
  </ul>
  
</nav>
<?php endif ?>
<?php if($jobs['totalPages']==0):?>
Нет записей
<?php endif ?>
