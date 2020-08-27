<h1>Редактировать задачу</h1>
<form method="post" action="/?path=home/edit&id=<?=$job['id']?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>

    <input value="<?=$job['email']?>" type="text" id="exampleInputEmail1" name="email" class="form-control"  aria-describedby="emailHelp" placeholder="Введите email">

  </div>
  <div class="form-group">
    <label for="exampleInput2">Имя автора</label>
    <input  value="<?=$job['author']?>"  type="text" id="exampleInput2" name="author" class="form-control" placeholder="Введите имя">
  </div>
  <div class="form-group">
    <label for="exampleInput3">Текст задачи</label>
    <input  value="<?=$job['text']?>"  type="text" id="exampleInput3" name="text" class="form-control" placeholder="Введите текст задачи">
  </div>
  <div class="form-group">
    <label for="exampleInput4">Статус</label>
    <input <?=$job['status'] > 0 ? 'checked' : ''?>  type="checkbox" id="exampleInput4" name="status" class="form-control">
  </div>

  <button type="submit" name="edit" value="edit" class="btn btn-primary">Сохранить</button>
</form>
