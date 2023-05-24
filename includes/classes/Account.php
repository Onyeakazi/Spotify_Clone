<?php 
    class Account {

        private $con;
        private $errorArray;
        public function __construct($con) {
            $this->con = $con;
            $this->errorArray = array();
        }

        public function login($un, $pw) {
            $Pw = md5($pw);

            $query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$Pw' ");
            if(mysqli_num_rows($query) == 1) {
                return true;
            } else {
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }

        public function register($un, $fn, $ln, $em, $pw, $pw2) {
            $this->validateUsername($un);
            $this->validateFirstname($fn);
            $this->validateLastname($ln);
            $this->validateEmail($em);
            $this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray) == true) {
                return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
            } else {
                return false;
            }

        }

        public function getError($error) {
                if(!in_array($error, $this->errorArray)) {
                    $error = "";
                } 
            return "<span class='errorMessage'>$error</span>";
        }

        private function insertUserDetails($un, $fn, $ln, $em, $pw) {
            $encryptedPw = md5($pw);
            $profilePic = "assets/images/profile-pics/profile.jpg";
            $date = date("Y-m-d");

            $result = mysqli_query($this->con, "INSERT INTO users VALUES('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");

            return $result;
        }

        private function validateUsername($un) {

            if(strlen($un) > 10 || strlen($un) < 5) {
                array_push($this->errorArray, Constants::$usernameCharacters);
                return;
            }

            $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
            if(mysqli_num_rows($checkUsernameQuery) != 0) {
                array_push($this->errorArray, Constants::$usernameExists);
                return;
            }

        }
        
        private function validateFirstname($fn) {
            if(strlen($fn) > 10 || strlen($fn) < 5) {
                array_push($this->errorArray, Constants::$firstnameCharacters);
                return;
            }
        }
        
        private function validateLastname($ln) {
            if(strlen($ln) > 10 || strlen($ln) < 5) {
                array_push($this->errorArray, Constants::$lastnameCharacters);
                return;
            }
        }
        
        private function validateEmail($em) {
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }

            $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
            if(mysqli_num_rows($checkEmailQuery) != 0) {
                array_push($this->errorArray, Constants::$emailExist);
                return;
            }
        }
        
        private function validatePasswords($pw, $pw2) {
            if($pw != $pw2) {
                array_push($this->errorArray, Constants::$passwordsDoNotMatch);
                return;
            }

            // if(preg_match("/[^A-Za-z0-9]", $pw)) {
            //     array_push($this->errorArray, "Your passwords do not match!!");
            //     return;
            // }

            if(strlen($pw) > 20 || strlen($pw) < 5) {
                array_push($this->errorArray, Constants::$passwordsCharacters);
                return;
            }
        }


    }


?>