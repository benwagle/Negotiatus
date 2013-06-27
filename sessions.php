<?php
 
 function validateUser($username, $email)
{
   session_regenerate_id();
   $_SESSION['valid']=1;
   $_SESSION['user']= $username;
   $_SESSION['email']= $email;
}
   
 function isLoggedIn()
 {
 if(isset($_SESSION['valid']) && $_SESSION['valid'])
       return 1;
    return 0;
 }
 
 function logout()
 {
   $_SESSION = array();
   session_destroy();
   header('Location: index.php', true, 302);
 }

?>