<?php
	require APP_ROOT . '/views/inc/head.php';
	require APP_ROOT . '/views/inc/nav.php';
?>

<div class="container">
    <?php if(isLoggedIn()): ?>
    <a class="btn green" href="<?php echo URL_ROOT; ?>/articles/create">
        Create
	</a>
	<?php endif;?>

	<br>
	<br>
	<a class="btn dark">Filtre par categories : </a>
	<br>
	<br>
	
	<!-- AFFICHAGE ARTICLE -->
	<a class="btn dark" href="<?php echo URL_ROOT; ?>/articles">All</a>
	<?php foreach($data['categories'] as $category): ?>
		<a class="btn dark" href="<?= URL_ROOT . "/articles/filter/" . $category->cat_name ?>"><?= $category->cat_name ?></a>
	<?php endforeach; ?>

	<br>
	<br>
	<br>
	<a class="btn dark">Filtre par users : </a>
	<br>
	<br>

	<!-- AFFICHAGE UTILISATEURS -->
	<a class="btn dark" href="<?php echo URL_ROOT; ?>/articles">All</a>
	<?php foreach($data['users'] as $user): ?>
		<a class="btn dark" href="<?= URL_ROOT . "/articles/filter/" . $user->firstname ?>"><?= $user->firstname ?></a>
	<?php endforeach; ?>



	<!-- AFFICHAGE ARTICLE -->
	<?php foreach($data['articles'] as $article): ?>
		<div class="container-item">

			<!-- SI l'id d'autheur de l'article est celui l'utilisateur actuel alors il peut modifier-->
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
				<a href="<?= URL_ROOT . "/articles/show/" . $article->art_id ?>">
					<?php echo ucwords($article->title); ?>
				</a>
			</h2>

			<p>
				Description : <bold> <?php echo $article->description ?> </bold>
			</p>
			<p>
				Contenu : <bold> <?php echo $article->body ?> </bold>
			</p>
			
			<h6>
				<?php echo 'Created on: ' . date('F j h:m', strtotime($article->created_at)) ?>
			</h6>
			
			
		</div>
	<?php endforeach; ?>
</div>


<?php
	require APP_ROOT . '/views/inc/footer.php';
?>