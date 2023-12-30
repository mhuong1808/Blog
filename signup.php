<?php 

require'config/constants.php';

// get back form data if there was a resistration error
$FirstName = $_SESSION['signup-data']['FirstName']  ?? null;
$LastName = $_SESSION['signup-data']['LastName']  ?? null;
$UserName = $_SESSION['signup-data']['UserName']  ?? null;
$Email = $_SESSION['signup-data']['Email']  ?? null;
$CreatPassword = $_SESSION['signup-data']['CreatPassword']  ?? null;
$ConfirmPassword = $_SESSION['signup-data']['ConfirmPassword']  ?? null;

//delete signup data session
unset($_SESSION['signup-data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH Website</title>
    <!--CUSTOM STYLESHEET-->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <!--ICONSCOUT CDN-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!--GG FONTS MONTERRAT-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

</head>
<body>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Sign Up</h2>
        <?php if(isset($_SESSION['signup'])) : ?> 
            <div class="alert__message error">
               <p>
                <?= $_SESSION['signup'];
                unset($_SESSION['signup']);
                ?>
               </p>
            </div>
        <?php endif ?>
        

        
        <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="FirstName" value="<?= $FirstName ?>" placeholder="First Name">
            <input type="text" name="LastName" value="<?= $LastName ?>" placeholder="Last Name">
            <input type="text" name="UserName" value="<?= $UserName ?>" placeholder="User Name">
            <input type="email" name="Email" value="<?= $Email ?>" placeholder="Email">
            <input type="password" name="CreatPassword" value="<?= $CreatPassword ?>" placeholder="Creat Password">
            <input type="password" name="ConfirmPassword" value="<?= $ConfirmPassword ?>" placeholder="Confirm Password">
            <div class="form__control">
                <label for="avatar">User Avatar</label>
                <input type="file" name="Avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Sign Up</button>
            <small>Already have an account? <a href="signin.php">Sign In Now</a>
            </small>
        </form>
    </div>
</section>
</body>

<?php
include 'partials/footer.php' ;
?>