<?php

    include 'config/db.php';

    // Get articles
    $a_query = "SELECT * FROM articles INNER JOIN categories ON articles.category_id = category.id";
    $a_result = pg_query($con, $a_query) or die("Не могу выполнить запрос к базе данных: " . $a_query . "\n");

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
            </ul>
        </div>
    </div>
        
    <div class="callout large primary">
        <div class="row column text-center">
            <h1>Статьи</h1>
        </div>
    </div>
        <div class="row" id="content">
            <div class="medium-8 columns">
                <?php while($row = pg_fetch_assoc($a_result)) : ?>
                    <div class="blog-post">
                    <h3><?= $row['title']; ?></h3>
                    <p><?= $row['body']; ?></p>
                    <div class="callout">
                        <ul class="menu simple">
                            <li>Категории</li>
                        </ul>
                    </div>
                </div>
                <?php endwhile; ?>
        </div>
        <div class="medium-3 columns" data-sticky-container>
            <div class="sticky" data-sticky data-anchor="content">
                <h4>Categories</h4>
                <ul>
                    <li><a href="#">Skyler</a></li>
                    <li><a href="#">Jesse</a></li>
                    <li><a href="#">Mike</a></li>
                    <li><a href="#">Holly</a></li>
                </ul>
            </div>
        </div>
    </div>
        

</body>
</html>


