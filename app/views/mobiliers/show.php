<?php
	require APP_ROOT . '/views/inc/head.php';
?>
<div class="navbar dark">
	<?php
		require APP_ROOT . '/views/inc/nav.php';
	?>
</div>

<div class="show">
	<h1><?= $data["mobilier"]->mobilier_name ?></h1>
	<p>Couleur : <b> <?= $data["mobilier"]->color ?> </b></p>
	<p>Mètre carré : <b> <?= $data["mobilier"]->size ?>² </b></p>
	<p>Prix : <b> <?= $data["mobilier"]->price ?>€ </b></p>
</div>

<div class="container center">
    <h1>Ajouter un commentaire</h1>

    <form method="post" action="<?php echo URL_ROOT; ?>/mobiliers/show/<?= $data["mobilier"]->id_mobilier ?>">

        <div class="form-item">
			<textarea name="text_content" id="text_content" cols="30" rows="10" placeholder="Votre commentaire..."></textarea>
        </div>

        <button id="submit" type="submit" value="submit">Poster !</button>
    </form>
</div>

<div class="comments-parent">
<?php foreach($data["comments"] as $comment): ?>
	<div class="comment">
		<h4><b> <?= $comment->username ?></b></h4>
		<p> <?= $comment->text_content ?> </p>
		<small>Posté le : <b> <?= $comment->comment_created_at ?> </b></small>
	</div>
<?php endforeach; ?>
</div>