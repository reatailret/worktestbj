<h1>Создать задачу</h1>
<form method="post" action="/?path=home/create">
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input  type="text" id="exampleInputEmail1" name="email" class="form-control"  aria-describedby="emailHelp" placeholder="Введите email">
    
  </div>
  <div class="form-group">
    <label for="exampleInput2">Имя автора</label>
    <input  type="text" id="exampleInput2" name="author" class="form-control" placeholder="Введите имя">
  </div>
  <div class="form-group">
    <label for="exampleInput3">Текст задачи</label>
    <input  type="text" id="exampleInput3" name="text" class="form-control" placeholder="Введите текст задачи">
  </div>
  
  <button type="submit" name="create" value="create" class="btn btn-primary">Создать</button>
</form>