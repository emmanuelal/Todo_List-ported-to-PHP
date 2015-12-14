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


function register( $email,$password,$hash){

// register new person with db
// return true or error message
// connect to db
$conn = connection();
// check if email is unique
$check_email = $conn->query("select * from users where email ='".$email."' ");
if(!$check_email){
   throw new Exception('Could not register user at this time.');
}
if ($check_email->num_rows>0) {
       throw new Exception('Email already found in the database ');
}
// if ok, put in db
$query = "INSERT INTO users(email,password,hash)VALUES(?,sha1(?),?)";
$stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $email, $password,$hash);
    if($stmt->execute()){
         return true;
    }
    $stmt->close();
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


function login_form(){
?>
<h1 class='headin'>Please Login</h1>
<div class="form">
<form method='post' action='http://localhost/ajax_loader/login_fns.php'>
    <div id="email">
        <input type='text' name='email' placeholder='Email Address'/>
    </div><!--email-->
    <div id="pasword">
        <input type='password' name='password' placeholder='Password'/>  
    </div><!--Password-->
    <div id="submit">
        <input type='submit' name='submit' value='Login' class='btn'/>
    </div><!--submit-->
    </form>
</div><!--Form-->
<?php
}
function check_valid_user() {
// see if somebody is logged in and notify them if not
   if (isset($_SESSION['valid_user'])) {
       return true;
   } else {
     // they are not logged in
      echo("<div class='container'>");
      echo("<div class='row'>");  
      echo("<div class='col-md-8'>");

      login_form();
      echo("</div>");
      echo("</div>");
      echo("</div>");
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

function last_page(){
   $_SESSION['last_page']=$_SERVER['HTTP_REFERER'];
   $page=$_SESSION['last_page'];
   if(isset($page)){
        return header("Location:".$page."");
   }else{
        return false;
   }
}


function check_profile(){
    
}

function create_profile(){

}

?>