<?php 
require APP_ROOT . '/views/inc/head.php';
require APP_ROOT . '/views/inc/nav.php';
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- AFFICHAGE ARTICLE -->
            <?php foreach($data['articles'] as $article): ?>
                <img src="<?= $article->image ?>" alt="<?= $article->slug ?>">
            <?php endforeach; ?>

            </div>
        </div>
    </div>
</main>



<?php 
require APP_ROOT . '/views/inc/footer.php';
?>