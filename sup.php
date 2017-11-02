<?php
require 'app/init.php';

$finder = new Finder(new Parsedown);

?>
<!doctype html>
<html lang="en_UK">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>RED|Clansite</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,400,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,400,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Miscellaneous CSS -->
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <link rel="stylesheet" type="text/css" href="/css/materialize-grid.min.css">
    </head>

    <body>
        <div class="menu">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/sup.php">What's going on</a></li>
                <li><a href="#protec">Namefaking</a></li>
            </ul>
        </div>
        <div class="menu-background"></div>
        
        <!-- Content starts here -->
        <section class="container articles">
            <?php foreach ($finder->list() as $article): ?>
                <div class="row">
                    <div class="col s12">
                        <?php echo $article->render(); ?>
                    </div>
                </div>
                <?php if ($article->meta('date')): ?>
                    <div class="row article-meta">
                        <div class="col s12">
                            Posted on: <?php echo $article->meta('date'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </section>
    </body>
</html>
