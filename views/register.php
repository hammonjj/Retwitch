<?php include('_header.php'); ?>

<!-- show registration form, but only if we didn't submit already -->
<?php if (!$registration->registration_successful && !$registration->verification_successful) { ?>
<div class="center">
<form method="post" action="register.php" name="registerform">
    <label for="user_name">Username</label>
    <input id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />

    <label for="user_email">E-Mail</label>
    <input id="user_email" type="email" name="user_email" required />

    <label for="user_password_new">Password</label>
    <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

    <label for="user_password_repeat">Re-Enter Password</label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />

    <img src="tools/showCaptcha.php" alt="captcha" />

    <label></label>
    <input type="text" name="captcha" required />

    <input type="submit" name="register" value="<?php echo WORDING_REGISTER; ?>" />
</form>
</div>
<?php } ?>

    <!-- <a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a> -->

<?php include('_footer.php'); ?>
