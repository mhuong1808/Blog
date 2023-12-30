<?php

require 'config/database.php';

//get signup form data if sign up button was clicked
if(isset($_POST['submit'])) {
     $FirstName = filter_var($_POST['FirstName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     $LastName = filter_var($_POST['LastName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     $UserName = filter_var($_POST['UserName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     $Email = filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL); //make sure its a real email
     $CreatPassword = filter_var($_POST['CreatPassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     $ConfirmPassword = filter_var($_POST['ConfirmPassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     $avatar = $_FILES['Avatar'];


     // validate input values
     if (!$FirstName) {
        $_SESSION['signup'] = "Please enter your First Name";
     } elseif (!$LastName) {
        $_SESSION['signup'] = "Please enter your Last Name"; 
     } elseif (!$UserName) {
        $_SESSION['signup'] = "Please enter your User Name"; 
     } elseif (!$Email) {
        $_SESSION['signup'] = "Please enter a valid Email"; 
     } elseif (strlen($CreatPassword) < 8 || strlen($ConfirmPassword) < 8) {
        $_SESSION['signup'] = "Password should be more than 8 characters"; 
     } elseif (!$avatar['name']) {
        $_SESSION['signup'] = "Please add your Avatar"; 
     } else {
        //check if password dont match
        if($CreatPassword !== $ConfirmPassword) {
            $_SESSION['signup'] = "Password do not match";
        } else {
            //hash password
            $hashed_password = password_hash($CreatPassword, PASSWORD_DEFAULT);

            //check if user name or email already exsist in database 
            $user_check_query = "SELECT * FROM users WHERE UserName ='$UserName'OR Email='$Email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if(mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "User Name or Email already exsist!";
            } else {
                //WORD ON AVATAR
                // rename avatar 
                $time = time(); //make each img name unique using current timestamp
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'image/' . $avatar_name;

                //make sure file is an img
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if(in_array($extention, $allowed_files)) {
                    //make sure img is not too large (1mb+)
                    if($avatar['size'] < 1000000000) {
                        //upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $extention['signup'] = "File size too big. Should be less than 1mb";
                    }
                } else {
                    $_SESSION['signup'] = "File should be png, jpg or jpeg";
                }
            }
        }
     }

     // redirect back to signup if there was any problem
     if (isset($_SESSION['signup'])) {
        // pass form data back to sign up page
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
     } else {
        // insert new user into users table
        $insert_user_query = "INSERT INTO users SET FirstName= '$FirstName', LastName='$LastName', UserName='$UserName', Email='$Email', Password='$hashed_password', Avatar='$avatar_name', Is_Admin=0";
        $insert_user_query = mysqli_query($connection, $insert_user_query);

        if(!mysqli_errno($connection)) {
            //redirect to login page with succes message
            $_SESSION['signup-success'] = "Registration successful. Please login!";
            header('location:' . ROOT_URL . 'signin.php');
            die();
        }
     }
    
} else {
    // if button wasn't clicked, bounce back to signup page
    header('location:' .ROOT_URL . 'signup.php');
    die();
}