<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Worktest</title>
  </head>
  <body>
  <div class="container">
  <ul class="nav">
  <li class="nav-item">
  <a class="nav-link active" href="/?path=home/index">Задачи</a>
  <a class="nav-link active" href="/?path=home/create">Создать задачу</a>
  <?php if ($isAdmin): ?>
    <a class="nav-link active" href="/?path=login/logout">Выход</a>
  <?php else: ?>
        <a class="nav-link active" href="/?path=login/index">Логин</a>
        <?php endif?>

  </li>
</ul>
      <?php if (isset($flashMessages)): ?>
        <?php foreach ($flashMessages as $message): ?>
            <div class="alert alert-<?=$message['class']?>" role="alert">
            <?=$message['message']?>
            </div>
        <?php endforeach?>
        <?php endif?>
  @PAGECONTENT
</div>

    
  </body>
</html>