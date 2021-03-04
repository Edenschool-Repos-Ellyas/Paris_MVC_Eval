
<?php 
require APP_ROOT . '/views/inc/head.php';
require APP_ROOT . '/views/inc/nav.php';
?>

<main>
     <!-- AFFICHAGE CATEGORIES -->
	<?php foreach($data['categories'] as $category): ?>

    <h2>Category name : <a href="<?= URL_ROOT; ?>/articles/category/<?= $category->cat_id ?>"><?= ucfirst($category->cat_name) ?></a></h2>
    <h4>Category description : <?= ucfirst($category->cat_description) ?></h4>

	<?php endforeach; ?>
</main>



<?php 
require APP_ROOT . '/views/inc/footer.php';
?>