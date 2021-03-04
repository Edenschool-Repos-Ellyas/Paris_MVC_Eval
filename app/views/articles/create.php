<?php
require APP_ROOT . '/views/inc/head.php';
require APP_ROOT . '/views/inc/nav.php';
?>

<main>
    <div class="container">
        <div class="row">


            <div class="col-lg-12">

            <h1>Crée un article</h1>

            <form method="post" action="<?php echo URL_ROOT; ?>/articles/create">

                <div class="form-item">
                    <select name="cat_id" id="cat_id">
                        <option value="">Choisir une catégorie</option>
                        <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->cat_id ?>"><?= $category->cat_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-item">
                    <input type="text" name="title" id="title" placeholder="titre">
                </div>

                <div class="form-item">
                    <input type="text" name="slug" id="slug" placeholder="slug">
                </div>

                <div class="form-item">
                    <input type="text" name="image" id="image" placeholder="lien image">
                </div>

                <div class="form-item">
                    <textarea name="description" id="description" cols="30" rows="10">Default description...</textarea>
                </div>

                <div class="form-item">
                    <textarea name="body" id="body" cols="30" rows="10">Default body...</textarea>
                </div>

                <button id="submit" type="submit" value="submit">Publier !</button>
            </form>

            </div>


        </div>
    </div>
</main>

<?php 
require APP_ROOT . '/views/inc/footer.php';
?>