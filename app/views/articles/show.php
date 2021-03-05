<?php
	require APP_ROOT . '/views/inc/head.php';
	require APP_ROOT . '/views/inc/nav.php';
?>



<main>
    <div class="container">
        <div class="row">


            <div class="col-lg-12">

			<div class="show">
				<h1><?= $data["article"]->title ?></h1>
				<p> description : <b> <?= $data["article"]->description ?> </b></p>
				<p>Contenu : <b> <?= $data["article"]->body ?>² </b></p>
				<p>crée le  : <b> <?= $data["article"]->created_at ?>€ </b></p>
			</div>

			<div class="container center">
				<?php if(isLoggedIn()): ?>
				<h3>Ajouter un commentaire</h3>

				<form method="post" action="<?php echo URL_ROOT; ?>/articles/show/<?= $data["article"]->art_id ?>">

					<div class="form-item">
						<textarea name="text" id="text" cols="30" rows="10" placeholder="Votre commentaire..."></textarea>
					</div>

					<button id="submit" type="submit" value="submit">Poster !</button>
				</form>

				<?php else: ?>
				<!-- If we're not logged -->
				<small><i>Pour ajouter un commentaire, connectez-vous <a href="<?= URL_ROOT . "/users/login" ?>" font-color="blue">ici</a></i></small>
				<?php endif; ?>

			</div>

			<div class="comments-parent">
				<?php foreach($data["comments"] as $comment): ?>
				<div class="comment">
					<h6><b><?= $comment->firstname ?></b> <b><?= $comment->lastname ?></b></h6>
					<p> <?= $comment->text ?> </p>
					<small>Posté le : <b> <?= $comment->created_at ?> </b></small>
				</div>
				<?php endforeach; ?>
			</div>

            </div>
			<!-- ./end col -->
            
        </div>
    </div>
</main>

<?php
	require APP_ROOT . '/views/inc/footer.php';
?>