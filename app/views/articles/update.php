<?php require APP_ROOT . '/views/inc/head.php'; ?>

<div class="navbar dark">
    <?php require APP_ROOT . '/views/inc/nav.php'; ?>
</div>

<div class="container center">
    <h1>Update article</h1>

    <form action="<?php echo URL_ROOT; ?>/articles/update/<?php echo $data['article']->id_article ?>" method="POST">

        <div class="form-item">
            <input type="text" name="article_name" value="<?php echo $data['article']->article_name ?>">
            <span class="invalidFeedback"><?php echo $data['article_nameError']; ?></span>
        </div>

        <div class="form-item">
            <input type="text" name="type" value="<?php echo $data['article']->type ?>">
            <span class="invalidFeedback"><?php echo $data['typeError']; ?></span>
        </div>

        <div class="form-item">
            <input type="text" name="color" value="<?php echo $data['article']->color ?>">
            <span class="invalidFeedback"><?php echo $data['colorError']; ?></span>
        </div>

        <div class="form-item">
            <input type="text" name="size" value="<?php echo $data['article']->size ?>">
            <span class="invalidFeedback"><?php echo $data['sizeError']; ?></span>
        </div>

        <div class="form-item">
            <input type="number" name="price" value="<?php echo $data['article']->price ?>">
            <span class="invalidFeedback"><?php echo $data['priceError']; ?></span>
        </div>

        <button class="btn green" name="submit" type="submit">Update</button>
    </form>
</div>


<!-- VA MODIFIER LES ERROR DANS LE MODEL OU CONTROLLER DE MOBILIER DANS LA FONCTION UPDATE -->