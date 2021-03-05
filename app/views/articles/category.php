
<?php 
require APP_ROOT . '/views/inc/head.php';
require APP_ROOT . '/views/inc/nav.php';
?>

<main>
    <div class="container">
    	<div class="row">
    		<h2>Category name : <?= ucfirst($data["category"]->cat_name) ?></h2>
		    <h4>Category description : <?= ucfirst($data["category"]->cat_description) ?></h4>
		    
		    <!-- AFFICHAGE ARTICLE -->
			<?php foreach($data['articles'] as $article): ?>
				<div class="container-item">
		
					<!-- SI l'id d'autheur de l'article est celui l'utilisateur actuel alors il peut modifier-->
					<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $article->user_id || isAdmin()): ?>
					
						<a class="btn orange" href="<?= URL_ROOT . "/articles/update/" . $article->art_id ?>">Modifier</a>

						<form action="<?= URL_ROOT . "/articles/delete/" . $article->art_id ?>" method="POST">
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
					
					<p>
						Crée le : <?= date('F j h:m', strtotime($article->created_at)) ?>
					</p>

					<p>
						Fait par : <a href="<?= URL_ROOT . "/users/profile/" . $article->user_id ?>"> <?= $article->firstname . ' ' . $article->lastname?> </a>
					</p>
					
					
				</div>
			<?php endforeach; ?>
    	</div>
    </div>
</main>



<?php 
require APP_ROOT . '/views/inc/footer.php';
?>