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
    <a class="btn green" href="<?php echo URL_ROOT; ?>/mobiliers/create">
        Create
    </a>
	<?php endif; ?>

	<br>
	<br>
	<a class="btn dark">Filtre par type : </a>
	<br>
	<br>

	<a class="btn dark" href="<?php echo URL_ROOT; ?>/mobiliers">All</a>
	<?php foreach($data['types'] as $type): ?>
		<a class="btn dark" href="<?= URL_ROOT . "/mobiliers/filter/" . $type->type ?>"><?= $type->type ?></a>
	<?php endforeach; ?>

	<br>
	<br>
	<br>
	<a class="btn dark">Filtre par users : </a>
	<br>
	<br>
	
	<a class="btn dark" href="<?php echo URL_ROOT; ?>/mobiliers">All</a>
	<?php foreach($data['users'] as $user): ?>
		<a class="btn dark" href="<?= URL_ROOT . "/mobiliers/filter/" . $user->user_id ?>"><?= $user->username ?></a>
	<?php endforeach; ?>

	<?php foreach($data['mobiliers'] as $mobilier): ?>
		<div class="container-item">
			<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $mobilier->user_id): ?>
				<a
					class="btn orange"
					href="<?php echo URL_ROOT . "/mobiliers/update/" . $mobilier->id_mobilier ?>">
					Update
				</a>
				<form action="<?php echo URL_ROOT . "/mobiliers/delete/" . $mobilier->id_mobilier ?>" method="POST">
					<input type="submit" name="delete" value="Delete" class="btn red">
				</form>
			<?php endif; ?>
			<h2>
				<a href="<?= URL_ROOT . "/mobiliers/show/" . $mobilier->id_mobilier ?>">
					<?php echo ucwords($mobilier->mobilier_name); ?>
				</a>
			</h2>

			<p>
				Couleur : <bold> <?php echo $mobilier->color ?> </bold>
			</p>
			<p>
				Prix : <bold> <?php echo $mobilier->price ?>&euro; </bold>
			</p>
			
			<h3>
				<?php echo 'Created on: ' . date('F j h:m', strtotime($mobilier->mobilier_created_at)) ?>
			</h3>
			
			
		</div>
	<?php endforeach; ?>
</div>