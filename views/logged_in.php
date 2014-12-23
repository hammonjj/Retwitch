<?php include('_header_logged_in.php'); ?>

<div id="userid" class="hidden"><?php echo htmlspecialchars($_SESSION['user_id']) ?></div>

<div id="wrapper">
    <div id="headerwrap">
        <div id="header" class="user_header">
            <div id="username"><?php echo htmlspecialchars($_SESSION['user_name']); ?></div>
            <a href="index.php?logout"><?php echo WORDING_LOGOUT; ?></a>
            <a href="edit.php"><?php echo WORDING_EDIT_USER_DATA; ?></a>
        </div>
    </div>

<?php include('logged_in_footer.html'); ?>
