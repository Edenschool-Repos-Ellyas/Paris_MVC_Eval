<?php
require APP_ROOT . '/views/inc/head.php';
?>
<div class="navbar dark">
    <?php
    require APP_ROOT . '/views/inc/nav.php';
    ?>
</div>

<div class="container center">
    <h1>Crée un article</h1>

    <form method="post" action="<?php echo URL_ROOT; ?>/articles/create">
        <div class="form-item">
            <input type="text" name="article_name" id="article_name" placeholder="nom du article">
        </div>

        <div class="form-item">
            <input type="text" name="color" id="color" placeholder="Couleur">
        </div>

        <div class="form-item">
            <input type="text" name="type" id="type" placeholder="Type">
        </div>

        <div class="form-item">
            <input type="number" name="size" id="size" placeholder="Size">
        </div>

        <div class="form-item">
            <input type="number" name="price" id="price" placeholder="Price">
        </div>

        <button id="submit" type="submit" value="submit">Submit</button>
    </form>
</div>