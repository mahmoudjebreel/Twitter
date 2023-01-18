<?php

// if(isset($_SESSION['userLoggedIn'])){
//     redirect_to(url_for("home"));
// }else if(Login::isLoggedIn()){
//     redirect_to(url_for("home"));
// }
if(is_post_request()){
    if(isset($_POST['firstName']) && !empty($_POST['firstName'])){
       $fname=FormSanitizer::formSanitizerName($_POST['firstName']);
       $lname=formSanitizer::formSanitizerName($_POST['lastName']);
       $email=formSanitizer::formSanitizerString($_POST['email']);
       $password=formSanitizer::formSanitizerString($_POST['pass']);
       $password2=formSanitizer::formSanitizerString($_POST['pass2']);

       $username=$account->generateUsername($fname,$lname);
       
       $wasSuccessful=$account->register($fname,$lname,$username,$email,$password,$password2);
       if($wasSuccessful){
           session_regenerate_id();
           $_SESSION['userLoggedIn']=$wasSuccessful;
           if(isset($_POST['remember'])){
               $_SESSION['rememberMe']=$_POST['remember'];
           }
           redirect_to(url_for("verification"));
       }
      
    }
}

?>