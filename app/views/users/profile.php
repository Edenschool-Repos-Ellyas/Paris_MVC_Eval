<?php 
require APP_ROOT . '/views/inc/head.php';
require APP_ROOT . '/views/inc/nav.php';
?>

<div class="container center">
    <h1>Update Profile</h1>

    <form action="<?php echo URL_ROOT; ?>/users/profile/<?php echo $data['user']->user_id ?>" method="POST">

        <div class="form-item">
            <label for="email">Votre mail :</label>
            <input type="text" name="email" id="email" value="<?php echo $data['user']->email ?>" disabled>
            <small>Cannot modify your email</small>
        </div>

        <div class="form-item">
            <label for="created_at">Date de création du compte :</label>
            <input type="text" name="created_at" id="created_at" value="<?php echo $data['user']->created_at ?>" disabled>
        </div>

        <div class="form-item">
            <label for="firstname">Votre prénom :</label>
            <input type="text" name="firstname" id="firstname" value="<?php echo $data['user']->firstname ?>">
        </div>

        <div class="form-item">
            <label for="lastname">Votre nom :</label>
            <input type="text" name="lastname" id="lastname" value="<?php echo $data['user']->lastname ?>">
        </div>

        <!-- FAIRE AFFICHER LE JOURNAL, LA BIO, LES HOBBIES, LE ROLE -->

        <button class="btn green" name="submit" type="submit">Mettre à jour</button>
    </form>
</div>
<script src="<?php echo URL_ROOT ?>/public/js/inputFilter.js"></script>

<?php 
require APP_ROOT . '/views/inc/footer.php';
?>