<?php
require_once('database/connection.php');
require_once('function/data_holder.php');
require_once('includes/output.html.php');

      add_header("Resetting password");
      // creating short variable name
      $username = $_POST['username'];
try {
      $password = reset_password($username);
      notify_password($username, $password);
      echo 'Your new password has been emailed to you.<br />';
}

catch (Exception $e) {
      echo 'Your password could not be reset - please try again later.';
}

    do_html_url('login.php', 'Login');
    add_footer();
?>