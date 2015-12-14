<?php


function filled_out($form_vars) {
     // test that each variable has a value
     foreach ($form_vars as $key => $value) {
     if ((!isset($key)) || ($value == '')) {
     return false;
    }
 }
return true;
}


function valid_email($address) {
// check an email address is possibly valid
   if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $address)) {
      return true;
   } else {
     return false;
   }
}


function register($username, $email, $age , $country, $city , $password){

// register new person with db
// return true or error message
// connect to db
$conn = connection();
// check if username is unique
$result = $conn->query("select * from users where username='".$username."'");

if (!$result) {
     throw new Exception('Could not execute query');
}

$check_email = $conn->query("select * from users where email ='".$email."' ");
if(!$check_email){
   throw new Exception('Could not register user at this time.');
}

if ($check_email->num_rows>0) {
       throw new Exception('Email already found in the database ');
}


// if ok, put in db

$result = $conn->query("insert into users(username , email, password , age, country, city ) values ('".$username."', '".$email."', sha1('".$password."'),'".$age."','".$country."', '".$city."' )");
if (!$result) {
   throw new Exception('Could not register you in database - please try again later.');
  }
return true;
}

function login($email, $password) {
// check username and password with db
// if yes, return true
// else throw exception
// connect to db
$conn = connection();
// check if username is unique
$result = $conn->query("select * from users where email='".$email."' and password = sha1('".$password."')");

if (!$result) {
    throw new Exception('unable to perform query.');
}
if ($result->num_rows>0) {
   return true;
} else {
    throw new Exception('Could not log you in.');
   }
}

function check_valid_user() {
// see if somebody is logged in and notify them if not
   if (isset($_SESSION['valid_user'])) {
       echo "Logged in as ".$_SESSION['valid_user'].".<br />";
   } else {
     // they are not logged in
do_html_heading('Problem:');
echo 'You are not logged in.<br />';
do_html_url('login.php', 'Login');
add_footer();
   exit;
   }
}
function change_password($username, $old_password, $new_password) {
// change password for username/old_password to new_password
// return true or false
// if the old password is right
// change their password to new_password and return true
// else throw an exception
login($username, $old_password);
$conn = connection();
$result = $conn->query("update users set password = sha1('".$new_password."') where username = '".$username."'");
if (!$result) {
throw new Exception('Password could not be changed.');
} else {
return true; // changed successfully
  }
}

function reset_password($username) {
  // set password for username to a random value
  // return the new password or false on failure
  // get a random dictionary word b/w 6 and 13 chars in length
    $new_password = get_random_word(6, 13);
    if($new_password == false) {
     throw new Exception('Could not generate new password.');
     }

    // add a number between 0 and 999 to it
    // to make it a slightly better password
    $rand_number = rand(0, 999);
    $new_password .= $rand_number;


// set user's password to this in database or return false
    $conn = connection();
    $result = $conn->query("update user
    set passwd = sha1('".$new_password."')
    where username = '".$username."'");
    if (!$result) {
        throw new Exception('Could not change password.'); // not changed
    } else {
        return $new_password; // changed successfully
  }
}


function get_random_word($min_length, $max_length) {
// grab a random word from dictionary between the two lengths
// and return it
// generate a random word
$word = '';
      // remember to change this path to suit your system
      $dictionary = '/usr/dict/words'; // the ispell dictionary
      $fp = @fopen($dictionary, 'r');
if(!$fp) {
       return false;
}

      $size = filesize($dictionary);
      // go to a random location in dictionary
       $rand_location = rand(0, $size);
fseek($fp, $rand_location);
// get the next whole word of the right length in the file
 while ((strlen($word) < $min_length) || (strlen($word)>$max_length) || (strstr($word, "'"))) {
        if (feof($fp)) {
           fseek($fp, 0); // if at end, go to start
}

$word = fgets($fp, 80);
$word = fgets($fp, 80);

// skip first word as it could be partial
// the potential password
}
     $word = trim($word); // trim the trailing \n from fgets
     return $word;
}
function notify_password($username, $password) {
     // notify the user that their password has been changed
     $conn = connection();
     $result = $conn->query("select email from user where username='".$username."'");
if (!$result) {
        throw new Exception('Could not find email address.');
   } else if ($result->num_rows == 0) {
        throw new Exception('Could not find email address.');
// username not in db
   } else {

$row = $result->fetch_object();
$email = $row->email;
$from = "From: support@phpbookmark \r\n";
$mesg = "Your Boite Nou password has been changed to ".$password."\r\n"
."Please change it next time you log in.\r\n";
if (mail($email, 'Boite Nou login information', $mesg, $from)) {
return true;
} else {
throw new Exception('Could not send email.');
     }
   }
 }
function escape($string){
   return htmlentities($string ,ENT_QUOTES, "UTF-8");
}

?>