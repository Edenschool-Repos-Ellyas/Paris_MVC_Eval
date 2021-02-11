<?php require APP_ROOT . '/views/inc/head.php'; ?>

<div class="navbar dark">
    <?php require APP_ROOT . '/views/inc/nav.php'; ?>
</div>

<div class="container center">
    <h1>Update Profile</h1>

    <form action="<?php echo URL_ROOT; ?>/users/profile/<?php echo $data['user']->user_id ?>" method="POST">

        <div class="form-item">
        <label for="email">Votre username : *</label>
            <input type="text" name="username" value="<?php echo $data['user']->username ?>">
            <span class="invalidFeedback"><?php echo $data['usernameError']; ?></span>
        </div>

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

        <div class="form-item">
            <label for="address">Votre adresse :</label>
            <input type="text" name="address" id="email" value="<?php echo $data['user']->address ?>">
        </div>

        <div class="form-item">
            <label for="zip_code">Votre code postal :</label>
            <input type="text" name="zip_code" id="zip_code" value="<?php if($data['user']->zip_code != 0) echo $data['user']->zip_code; ?>" maxlength="5" minlength="5">
        </div>

        <button class="btn green" name="submit" type="submit">Mettre à jour</button>
    </form>
</div>
<script src="<?php echo URL_ROOT ?>/public/js/inputFilter.js"></script>