<?php

    include 'config/db.php';

    // Get categories
    $c_query = "SELECT * FROM categories";
    $c_result = pg_query($con, $c_query) or die("Не могу выполнить запрос к базе данных: " . $c_query . "\n");

    // INSERT New Post
    if (isset($_POST['submit'])) {
        $title = htmlspecialchars(trim($_POST['title']));
        $body = htmlspecialchars(trim($_POST['body']));
        $category_id = $_POST['category_id'];

        $result = pg_query_params("INSERT INTO articles(title, body, category_id) VALUES($1, $2, $3)", 
                                    [$title, $body, $category_id]
                                  );

        header('Location: index.php');
    }


    pg_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PostgreSQL Blog</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.2.4/foundation.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="menu">
                 <li class="menu-text">PostgreSQL Blog</li>
            </ul>
        </div>
        
        <div class="top-bar-right">
            <ul class="menu">
                <li><a href="index.php">Главная</a></li>
                <li><a href="new.php">Добавить статью</a></li>
            </ul>
        </div>
    </div>
        
    <div class="callout large primary">
        <div class="row column text-center">
            <h1>Блог на PostgreSQL</h1>
        </div>
    </div>
        <div class="row" id="content">
            <div class="medium-8 columns">
                <h2>Новая статья</h2>

                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="row">   
                        <div class="medium-12 columns">
                            <label>Заголовок
                                <input type="text" name="title" placeholder="Введите заголовок ..." />
                            </label>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="medium-12 columns">
                            <label>Текст статьи
                                <textarea name="body" rows="7" placeholder="Введите содержание статьи ..."></textarea>
                            </label>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="medium-12 columns">
                            <label>Категория
                                <select name="category_id">
                                    <option value="0">Выберите категорию:</option>
                                    <?php while($row = pg_fetch_assoc($c_result)) : ?>
                                        <option value="<?= $row['id']?>"><?= $row['name']?></option>
                                    <?php endwhile; ?>
                                </select>
                            </label>
                        </div>
                    </div>
                    <br />
                    <input type="submit" name="submit" value="Добавить" class="button">
                </form>

            </div>
    </div>
        

</body>
</html>


