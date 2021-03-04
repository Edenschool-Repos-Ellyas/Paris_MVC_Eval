<?php 
require APP_ROOT . '/views/inc/head.php';
require APP_ROOT . '/views/inc/nav.php';
?>

<main>
    <div class="container">
        <div class="row">


            <div class="col-lg-12">

                <?php if(isLoggedIn() && $_SESSION["user_id"] === $data["user"]->user_id): ?>
                <!-- SI LE PROFIL EST PAS LE NOTRE -->
                
                <h1>Update Profile</h1>

                <form action="<?php echo URL_ROOT; ?>/users/profile/<?php echo $data['user']->user_id ?>" method="POST">

                    <div class="form-item">
                        <label for="">Votre mail :</label>
                        <input type="text" name="" id="" value="<?php echo $data['user']->email ?>" disabled>
                    </div>

                    <div class="form-item">
                        <label for="">Date de création du compte :</label>
                        <input type="text" name="" id="" value="<?php echo date("j F, Y", strtotime($data['user']->created_at)) ?>" disabled>
                    </div>

                    <div class="form-item">
                        <label for="">Votre prénom :</label>
                        <input type="text" name="" id="" value="<?php echo $data['user']->firstname ?>" disabled>
                    </div>

                    <div class="form-item">
                        <label for="">Votre nom :</label>
                        <input type="text" name="" id="" value="<?php echo $data['user']->lastname ?>" disabled>
                    </div>
                    
                    <div class="form-item">
                        <label for="">Votre role :</label>
                        <input type="text" name="" id="" value="<?php echo $data['user']->role ?>" disabled>
                    </div>

                    <?php if(isAuthor()): ?>
                    <div class="form-item">
                        <label for="journal_name">Votre journal :</label>
                        <input type="text" name="journal_name" id="journal_name" value="<?php echo $data['user']->journal_name ?>">
                    </div>
                    <?php endif; ?>

                    <div class="form-item">
                        <label for="picture">Votre lien d'de photo de profil :</label>
                        <input type="text" name="picture" id="picture" value="<?php echo $data['user']->picture ?>">
                        <img src="<?= $data['user']->picture ?>" alt="image de <?= $data['user']->firstname ?>">
                    </div>

                    <div class="form-item">
                        <label for="bio">Votre bio :</label>
                        <textarea name="bio" id="bio" cols="30" rows="10"><?php echo $data['user']->bio ?></textarea>
                    </div>

                    <div class="form-item">
                        <label for="hobbies">Votre hobbies :</label>
                        <textarea name="hobbies" id="hobbies" cols="30" rows="10"><?php echo $data['user']->hobbies ?></textarea>
                    </div>

                    <!-- FAIRE AFFICHER LE JOURNAL, LA BIO, LES HOBBIES, LE ROLE -->

                    <button class="btn green" name="submit" type="submit">Mettre à jour</button>
                </form>

                <?php else: ?>
                <!-- SI LE PROFIL N'EST PAS LE NOTRE -->

                    <div class="profile-container flex flex-wrap">
                        <div>
                            <img src="<?= $data["user"]->picture ?>" alt="picture of <?= $data["user"]->firstname . " " . $data["user"]->firstname ?>">
                        </div>
                        <div>
                            <h3><?= $data["user"]->firstname ." ". $data["user"]->lastname ?></h3>
                            <p><b>Bio :</b> <?= $data["user"]->bio ?></p>
                            <p><b>Hobbies :</b> <?= $data["user"]->hobbies ?></p>
                            <p><b>role :</b> <?= $data["user"]->role ?></p>
                            <small><i><b>crée le :</b> <?= date("j F, Y", strtotime($data["user"]->created_at)) ?></i></small>
                        </div>
                    </div>

                <?php endif; ?>

            </div>


        </div>
        <!-- ./row -->

        <br>

        <div class="row">
            <div class="col-lg-12 card-container">
                
                <h2 style="width: 100%;">Articles faits : </h2>
                <!-- AFFICHAGE ARTICLE -->
                <?php foreach($data['articles'] as $article): ?>
                
                <div class="card">
                    <img src="<?= $article->image ?>" alt="<?= $article->slug ?>">
                    <div>
                        <h4><a href="<?= URL_ROOT . "/articles/show/" . $article->art_id ?>"><?= $article->title ?></a></h4>
                        <p><?= $article->description ?></p>
                    </div>
                    <?php if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $article->user_id ||  isAdmin()): ?>
                    <form action="<?= URL_ROOT . "/articles/delete/" . $article->art_id ?>" method="POST">
					    <input type="submit" name="delete" value="delete" data-action="delete" class="btn red">
				    </form>
                    <a href="<?= URL_ROOT . "/articles/update/" . $article->art_id ?>" data-action="modify" class="btn green">Modifier</a>
                    <?php endif; ?>
                </div>
                
                <?php endforeach; ?>
                
            </div>
        </div>
        <!-- ./row -->


    </div>
</main>
<script src="<?php echo URL_ROOT ?>/public/js/inputFilter.js"></script>

<?php 
require APP_ROOT . '/views/inc/footer.php';
?>