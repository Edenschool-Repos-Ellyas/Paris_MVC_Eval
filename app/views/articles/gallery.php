<?php 
require APP_ROOT . '/views/inc/head.php';
require APP_ROOT . '/views/inc/nav.php';
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 card-container">

                <!-- AFFICHAGE ARTICLE -->
                <?php foreach($data['articles'] as $article): ?>

                <div class="card">
                    <img src="<?= $article->image ?>" alt="<?= $article->slug ?>">
                    <div>
                        <h4><a href="<?= URL_ROOT . "/articles/show/" . $article->art_id ?>"><?= $article->title ?></a></h4>
                        <p><?= $article->description ?></p>
                    </div>

                    <?php if(isAdmin()): ?>
                    <form action="<?= URL_ROOT . "/articles/delete/" . $article->art_id ?>" method="POST">
					    <input type="submit" name="delete" value="delete" data-action="delete" class="btn red">
				    </form>
                    <a href="<?= URL_ROOT . "/articles/update/" . $article->art_id ?>" data-action="modify" class="btn green">Modifier</a>
                    <?php endif; ?>
                </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
</main>



<?php 
require APP_ROOT . '/views/inc/footer.php';
?>