<?php
require 'config/database.php';

if(isset($_POST['submit'])) {
    // get upadted form data
    $Id = filter_var($_POST['Id'], FILTER_SANITIZE_NUMBER_INT);
    $FirstName = filter_var($_POST['FirstName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $LastName = filter_var($_POST['LastName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $Is_Admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    // check for valid input
    if (!$FirstName || !$LastName) {
        $_SESSION['edit-user'] = "Invalid form input on edit page.";
    } else {
        // update user
        $query = "UPDATE users SET FirstName= '$FirstName', LastName= '$LastName', Is_Admin= $Is_Admin WHERE id= $Id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Failed to update user.";
        } else {
            $_SESSION['edit-user-success'] = "User $FirstName $LastName updated successfully.";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();