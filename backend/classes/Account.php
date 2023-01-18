<?php

class Account
{
    private $pdo;
    private $errorArray = array();

    public function __construct()
    {
    
       $this->pdo = Database::instance();
    }

    public function register($fn,$ln,$un,$em,$pw,$pw2)
    {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateEmails($em);
        $this->validatePassword($pw,$pw2);

        if(empty($this->errorArray))
        {
            return $this->insertUserDetails($fn,$ln,$un,$em,$pw);
        }
        else
        {
            return true;
        }
    }
    public function insertUserDetails($fn,$ln,$un,$em,$pw)
    {
        $pass_hash=password_hash($pw,PASSWORD_BCRYPT);
        $random = rand(0,2);
        if($random == 0)
        {
            $profilePic="frontend/assets/images/defaultProfilePic.png";
            $profileCover="frontend/assets/images/backgroundCoverPic.svg";
        }else if($random==1)
        {
         $profilePic="frontend/assets/images/defaultPic.svg";
         $profileCover="frontend/assets/images/backgroundImage.svg";
        }else if($random==2)
        {
             $profilePic="frontend/assets/images/profilePic.jpeg";
             $profileCover="frontend/assets/images/backgroundCoverPic.svg";
        }
        $stmt=$this->pdo->prepare("INSERT INTO  users (firstName,lastName,username,email,password,profileImage,profileCover) VALUES (:fn,:ln,:un,:em,:pw,:pic,:cov)");
        $stmt->bindParam(":fn",$fn,PDO::PARAM_STR);
        $stmt->bindParam(":ln",$ln,PDO::PARAM_STR);
        $stmt->bindParam(":un",$un,PDO::PARAM_STR);
        $stmt->bindParam(":em",$em,PDO::PARAM_STR);
        $stmt->bindParam(":pw",$pass_hash,PDO::PARAM_STR);
        $stmt->bindParam(":pic",$profilePic,PDO::PARAM_STR);
        $stmt->bindParam(":cov",$profileCover,PDO::PARAM_STR);
        
        $stmt->execute();
        return $this->pdo->lastInsertId();
     }


    private function validateFirstName($fn)
    {
       
        if($this->length($fn,2,25))
        {
            return array_push($this->errorArray,Constant::$firstNameCharacters);
        }
    }

    private function validateLastName($ln)
    {
    
        if($this->length($ln,2,25))
        {
            return array_push($this->errorArray,Constant::$lastNameCharacters);
        }
    }

    private function validateEmails($em)
    {
        //Prepared statements are very useful against SQL injections. // prepare()
        $stmt=$this->pdo->prepare("SELECT * FROM `users` WHERE email=:email");
        //In our SQL, we insert a question mark (?) where we want to substitute in an integer, string, double or blob value.
        //Then, have a look at the bind_param() function
        $stmt->bindParam(":email",$em,PDO::PARAM_STR);
        //execute(): At a later time, the application binds the values to the parameters, and the database executes the statement. The application may execute the statement as many times as it wants with different values
        $stmt->execute();
        //Returns the number of rows affected by the last SQL statement    //rowCount()
        $count=$stmt->rowCount();
        if($count >0)
        {
            return array_push($this->errorArray,Constant::$emailInUse);
        }
        if(!filter_var($em,FILTER_VALIDATE_EMAIL))
        {
            return array_push($this->errorArray,Constant::$emailInValid);
        }
    }
    
    private function validatePassword($pw,$pw2)
    {
        
        if($pw != $pw2)
        {
            return array_push($this->errorArray,Constant::$passwordDoNotMatch);
        }
        //The preg_match() function returns whether a match was found in a string.
        if(preg_match("/[^A-Za-z0-9]/",$pw))
        {
            return array_push($this->errorArray,Constant::$passwordNotAlphanumeric);
        }
        if($this->length($pw,5,30))
        {
            return array_push($this->errorArray,Constant::$passwordLength);
        }
    }


    private function length($input,$min,$max)
    {
        if(strlen($input) < $min)
        {
            return true;
        }
        else if(strlen($input) > $max)
        {
            return true;
        }
    }

    public function getErrorMessage($error)
    {
        if(in_array($error,$this->errorArray))
        {
            return "<span class='errorMessage'>$error</span>";
        }
    }

    public function generateUsername($fn,$ln)
    {
        if(!empty($fn) && !empty($ln))
        {
            //in_array():Search for the value "" in an array
           if(!in_array(Constant::$firstNameCharacters,$this->errorArray) && !in_array(Constant::$lastNameCharacters,$this->errorArray))
           {
                $username = strtolower($fn.''.$ln);
                if($this->checkUsernameExist($username))
                {
                    $screenRand=rand();
                    $userLink=$username.''.$screenRand;
                }
                else
                {
                    $userLink = $username;
                }
                return $userLink;
           }
        }
    }

    private function checkUsernameExist($username)
    {
        $stmt=$this->pdo->prepare("SELECT * FROM `users` WHERE username=:username");
        $stmt->bindParam(":username",$username,PDO::PARAM_STR);
        $stmt->execute();
        $count=$stmt->rowCount();
        if($count >0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}