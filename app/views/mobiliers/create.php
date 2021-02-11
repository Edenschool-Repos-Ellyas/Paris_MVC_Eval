<?php
require APP_ROOT . '/views/inc/head.php';
?>
<div class="navbar dark">
    <?php
    require APP_ROOT . '/views/inc/nav.php';
    ?>
</div>

<div class="container center">
    <h1>Crée un mobilier</h1>

    <form method="post" action="<?php echo URL_ROOT; ?>/mobiliers/create">
        <div class="form-item">
            <input type="text" name="mobilier_name" id="mobilier_name" placeholder="nom du mobilier">
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