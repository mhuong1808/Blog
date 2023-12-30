<?php
require 'config/database.php'; 

if(isset($_POST['submit'])) {
    // get form data
    $UserName_Email = filter_var($_POST['UserName_Email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $Password = filter_var($_POST['Password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$UserName_Email) {
        $_SESSION['signin'] = "User Name or Email required";
    } elseif (!$Password) {
        $_SESSION['signin'] = "Password Required";
    } else {
        // fetch user from database
        $fetch_user_query = "SELECT * FROM users WHERE UserName= '$UserName_Email' OR Email='$UserName_Email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            //convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['Password'];
            //compare form password with database password
            if(password_verify($Password, $db_password)) {
                //set section for access control
                $_SESSION['user-id'] = $user_record['Id'];
                // set session if user is an admin
                if ($user_record['Is_Admin'] == 1 ) {
                    $_SESSION['User_Is_Admin'] = true;
                }

                //log user in
                header('location:' . ROOT_URL . 'admin/');
            } else {
                $_SESSION['signin'] = "Please check your input";
            }
        } else {
            $_SESSION['signin'] = "User not found";
        }
    }


    // if any problem, redirect back to signin page with login data
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location:' . ROOT_URL .'signin.php');
        die();
    }
} else {
    header('location:' . ROOT_URL . 'signin.php');
    die();
}