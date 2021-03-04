<?php
require APP_ROOT . '/views/inc/head.php';
require APP_ROOT . '/views/inc/nav.php';
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 center">
                <h1>Update article</h1>
            
                <form action="<?= URL_ROOT; ?>/articles/update/<?= $data['article']->art_id ?>" method="POST">
            
                    <div class="form-item">
                        <select name="cat_id" id="cat_id">
                            <!-- foreach to find the name of the actual category -->
                            <?php
                            foreach ($categories as $category):
                                if($category->cat_id == $data["article"]->cat_id):    
                            ?>
                            <option value="<?= $category->cat_id ?>"><?= $category->cat_name ?></option>
                            
                            <?php
                                    break;
                                endif;
                            endforeach;
                            ?>
                            <!-- end foreach to find the name of the actual category -->

                            <?php
                            foreach ($categories as $category):
                                if($category->cat_id == $data["article"]->cat_id):    
                                    continue;
                                endif;
                            ?>
                            <option value="<?= $category->cat_id ?>"><?= $category->cat_name ?></option>
                            
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
            
                    <div class="form-item">
                        <input type="text" name="title" id="title" value="<?php echo $data['article']->title ?>"> 
                        <span class="invalidFeedback"><?php echo $data['titleError']; ?></span>
                    </div>
            
                    <div class="form-item">
                        <input type="text" name="slug" value="<?php echo $data['article']->slug ?>">
                        <span class="invalidFeedback"><?php echo $data['slugError']; ?></span>
                    </div>
            
                    <div class="form-item">
                        <input type="text" name="image" value="<?php echo $data['article']->image ?>">
                        <span class="invalidFeedback"><?php echo $data['imageError']; ?></span>
                    </div>
            
                    
                    <div class="form-item">
                        <textarea name="description" id="description" cols="30" rows="10"><?= $data['article']->description ?></textarea>
                        <span class="invalidFeedback"><?php echo $data['descriptionError']; ?></span>
                    </div>
            
                    <div class="form-item">
                        <textarea name="body" id="body" cols="30" rows="10"><?= $data['article']->body ?></textarea>
                        <span class="invalidFeedback"><?php echo $data['bodyError']; ?></span>
                    </div>
            
                    <button class="btn green" name="submit" type="submit">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</main>
