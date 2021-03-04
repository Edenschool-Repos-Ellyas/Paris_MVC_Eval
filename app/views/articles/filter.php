<?php
	require APP_ROOT . '/views/inc/head.php';
?>
<div class="navbar dark">
	<?php
		require APP_ROOT . '/views/inc/nav.php';
	?>
</div>

<div class="container">
    <?php if(isLoggedIn()): ?>
    <a class="btn green" href="<?php echo URL_ROOT; ?>/articles/create">
        Create
    </a>
	<?php endif; ?>

	<br>
	<br>
	<a class="btn dark">Filtre par type : </a>
	<br>
	<br>

	<a class="btn dark" href="<?php echo URL_ROOT; ?>/articles">All</a>
	<?php foreach($data['types'] as $type): ?>
		<a class="btn dark" href="<?= URL_ROOT . "/articles/filter/" . $type->type ?>"><?= $type->type ?></a>
	<?php endforeach; ?>

	<br>
	<br>
	<br>
	<a class="btn dark">Filtre par users : </a>
	<br>
	<br>
	
	<a class="btn dark" href="<?php echo URL_ROOT; ?>/articles">All</a>
	<?php foreach($data['users'] as $user): ?>
		<a class="btn dark" href="<?= URL_ROOT . "/articles/filter/" . $user->user_id ?>"><?= $user->username ?></a>
	<?php endforeach; ?>

	<?php foreach($data['articles'] as $article): ?>
		<div class="container-item">
			<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $article->user_id): ?>
				<a
					class="btn orange"
					href="<?php echo URL_ROOT . "/articles/update/" . $article->id_article ?>">
					Update
				</a>
				<form action="<?php echo URL_ROOT . "/articles/delete/" . $article->id_article ?>" method="POST">
					<input type="submit" name="delete" value="Delete" class="btn red">
				</form>
			<?php endif; ?>
			<h2>
				<a href="<?= URL_ROOT . "/articles/show/" . $article->id_article ?>">
					<?php echo ucwords($article->article_name); ?>
				</a>
			</h2>

			<p>
				Couleur : <bold> <?php echo $article->color ?> </bold>
			</p>
			<p>
				Prix : <bold> <?php echo $article->price ?>&euro; </bold>
			</p>
			
			<h3>
				<?php echo 'Created on: ' . date('F j h:m', strtotime($article->article_created_at)) ?>
			</h3>
			
			
		</div>
	<?php endforeach; ?>
</div>