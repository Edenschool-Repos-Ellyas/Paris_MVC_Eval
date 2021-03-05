<?php
require APP_ROOT . '/views/inc/head.php';
require APP_ROOT . '/views/inc/nav.php';
?>

<main>
    <div class="container container-login">
        <div class="row">
            <div class="wrapper-login">
                <h2>Register</h2>
        
                <form
                    id="register-form"
                    method="POST"
                    action="<?php echo URL_ROOT; ?>/users/register"
                >
                    <input type="text" placeholder="Firstname *" name="firstname">
                    <span class="invalidFeedback">
                        <?php echo $data['firstnameError']; ?>
                    </span>
        
                    <input type="text" placeholder="Lastname *" name="lastname">
                    <span class="invalidFeedback">
                        <?php echo $data['lastnameError']; ?>
                    </span>
        
                    <input type="email" placeholder="Email *" name="email">
                    <span class="invalidFeedback">
                        <?php echo $data['emailError']; ?>
                    </span>
        
                    <input type="password" placeholder="Password *" name="password">
                    <span class="invalidFeedback">
                        <?php echo $data['passwordError']; ?>
                    </span>
        
                    <input type="password" placeholder="Confirm Password *" name="confirmPassword">
                    <span class="invalidFeedback">
                        <?php echo $data['confirmPasswordError']; ?>
                    </span>
        
                    <button id="submit" type="submit" value="submit">Submit</button>
        
                    <p class="options">Already ahve an account? <a href="<?php echo URL_ROOT; ?>/users/login">Sign in!</a></p>
                </form>
            </div>
        </div>
    </div>
</main>


<?php
require APP_ROOT . '/views/inc/footer.php';
?>