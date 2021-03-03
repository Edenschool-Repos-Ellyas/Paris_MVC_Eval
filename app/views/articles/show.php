<?php
	require APP_ROOT . '/views/inc/head.php';
	require APP_ROOT . '/views/inc/nav.php';
?>

<div class="show">
	<h1><?= $data["article"]->title ?></h1>
	<p> description : <b> <?= $data["article"]->description ?> </b></p>
	<p>Contenu : <b> <?= $data["article"]->body ?>² </b></p>
	<p>crée le  : <b> <?= $data["article"]->created_at ?>€ </b></p>
</div>

<div class="container center">
    <h1>Ajouter un commentaire</h1>

    <form method="post" action="<?php echo URL_ROOT; ?>/articles/show/<?= $data["article"]->art_id ?>">

        <div class="form-item">
			<textarea name="text" id="text" cols="30" rows="10" placeholder="Votre commentaire..."></textarea>
        </div>

        <button id="submit" type="submit" value="submit">Poster !</button>
    </form>
</div>

<div class="comments-parent">
<?php foreach($data["comments"] as $comment): ?>
	<div class="comment">
		<h4><b> <?= $comment->username ?></b></h4>
		<p> <?= $comment->text ?> </p>
		<small>Posté le : <b> <?= $comment->created_at ?> </b></small>
	</div>
<?php endforeach; ?>
</div>