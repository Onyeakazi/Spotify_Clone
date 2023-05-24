<?php 
    include("includes/config.php");
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");

    $account = new Account($con);

    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");

    function getInputValid($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\bootstrap-icons\bootstrap-icons-1.10.5\font\bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Spotify</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> 
</head>
<body>
    <?php 
        if(isset($_POST['registerButton'])) {
            echo '<script>
                    $(document).ready(function() {
                        $("#loginForm").hide();
                        $("#registerForm").show();
                    });
                </script>';
        } else {
            echo '<script>
                    $(document).ready(function() {
                        $("#loginForm").show();
                        $("#registerForm").hide();
                    });
                </script>';
        }
    
    ?>
     <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">
                <form id="loginForm" action="register.php" method="POST">
                    <h2>Login to your account</h2>
                    <p>
                        <label for="loginUsername">Username</label>
                        <input type="text" id="loginUsername" name="loginUsername" placeholder="e.g. berrylandon" value="<?php getInputValid('loginUsername') ?>" required>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                    </p>
                    <p>
                        <label for="loginPassword">Password</label>
                        <input type="password" id="loginPassword" name="loginPassword" required>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                    </p>

                    <button type="submit" name="loginButton">LOG IN</button>

                    <div class="hasAccountText">
                        <span id="hideLogin">Don't have an account yet? Signup here.</span>
                    </div>
                </form>



                <!-- ACCOUNT CREATING -->
                <form id="registerForm" action="register.php" method="POST">
                    <h2>Create a new account</h2>
                    <p>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="e.g. berrylandon" value="<?php getInputValid('username') ?>" required>
                        <?php echo $account->getError(Constants::$usernameCharacters); ?>
                        <?php echo $account->getError(Constants::$usernameExists); ?>
                    </p>

                    <p>
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" placeholder="e.g. Berry" value="<?php getInputValid('firstname') ?>" required>
                        <?php echo $account->getError(Constants::$firstnameCharacters); ?>
                    </p>
                    <p>
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" placeholder="e.g. Landon" value="<?php getInputValid('lastname') ?>" required>
                        <?php echo $account->getError(Constants::$lastnameCharacters); ?>
                    </p>
                    <p>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="e.g. berrylandon@gmail.com" value="<?php getInputValid('email') ?>" required>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailExist); ?>
                    </p>
                    <p>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Your Password" required>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$passwordsCharacters); ?>
                    </p>
                    <p>
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" id="confirmpassword" name="confirm_password" required>
                    </p>

                    <button type="submit" name="registerButton">SIGN UP</button>

                    <div class="hasAccountText">
                        <span id="hideRegister">Already have an account? Signin here.</span>
                    </div>
                </form>
            </div>

            <div id="loginText">
                <h1>Get great music, right now</h1>
                <h2>Listen to laods of songs for free</h2>
                <ul>
                    <li><i class="bi bi-check"></i> Discover music you love</li>
                    <li><i class="bi bi-check"></i> Create your own playlist</li>
                    <li><i class="bi bi-check"></i> Follow artists to keep up to date</li>
                </ul>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="assets/Jquery/jquery-3.6.4.min.js"></script>
    <script src="assets/js/register.js"></script>
</body>
</html>