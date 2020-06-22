<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mon Blog</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/css/Blog.css">
</head>
<body>

<div class="container">

    <div class="header">
        <!-- < ? = // $header ?> -->
    </div>

    <div class="bloc_articles">
    
        <?php while ($data = $posts->fetch() ) { ?>
        <div class="article">
            <div class="article_title">
                <h2><?php echo $data['title'];?></h2>
            </div>

            <div class="article_content">
                <div class="article_text">
                    <p><?php echo $data['content'];?></p>
                    <p><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Lire la suite</a></p>
                </div>
            </div>
        </div>
        <?php } ?>
    
    </div>

</div>


</body>
</html>