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
			<!-- ./end col -->
            
        </div>
    </div>
</main>


<?php
	require APP_ROOT . '/views/inc/footer.php';
?>