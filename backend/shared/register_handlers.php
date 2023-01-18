<?php

// if(isset($_SESSION['userLoggedIn'])){
//     redirect_to(url_for("home"));
// }else if(Login::isLoggedIn()){
//     redirect_to(url_for("home"));
// }
// 
if(is_post_request())
{
    if(isset($_POST['firstName']) && !empty($_POST['firstName']))
    {
        $fname       =   FormSanitizer::formSanitizerName($_POST['firstName']);
        $lname       =   FormSanitizer::formSanitizerName($_POST['lastName']);
        $email       =   FormSanitizer::formSanitizerString($_POST['email']);
        $password    =   FormSanitizer::formSanitizerString($_POST['pass']);
        $password2   =   FormSanitizer::formSanitizerString($_POST['pass2']);

        $username    =   $account->generateUsername($fname,$lname);
            //   echo $username;
        $wasSuccessful = $account->register($fname,$lname,$username,$email,$password,$password2);
        //    echo $wasSuccessful;
        if($wasSuccessful)
        {
            // session_regenerate_id();
            // $_SESSION['userLoggedIn']=$wasSuccessful;
            // if(isset($_POST['remember']))
            // {
            //     $_SESSION['rememberMe']=$_POST['remember'];
            // }
            echo "Data Inserted";

        }
        // redirect_to(url_for("verification"));
    }
      
}

?>