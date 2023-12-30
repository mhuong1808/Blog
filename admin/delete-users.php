<?php
require 'config/database.php';

if(isset($_GET['id'])) {
    $Id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch user from database
    $query = "SELECT * FROM users WHERE Id= $Id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // make sure got back only 1 user
    if(mysqli_num_rows($result) == 1) {
        $Avatar_Name = $user['Avatar'];
        $Avatar_Path = '../image/'. $Avatar_Name;

        //delete img if available 
        if($Avatar_Path) {
            unlink($Avatar_Path);
        }
    }

    // FOR LATER
    //Fetch all thumbnails of users posts and delete them
    $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=$Id";
    $thumbnails_result = mysqli_query($connection, $thumbnails_query);
    if (mysqli_num_rows($thumbnails_result) > 0) {
        while ($thumbnail = mysqli_fetch_assoc($thumbnails_result)) {
            $thumbnail_path = '../image/' . $thumbnail['thumbnail'];
            // delete thumbnail from image folder is exist 
            if($thumbnail_path) {
                unlink($thumbnail_path);
            }
        }
    }



    // delete user from database
    $delete_user_query = "DELETE FROM users WHERE Id= $Id";
    $selete_user_result = mysqli_query($connection, $delete_user_query);
    if(mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "Couldn't delete '{$user['FirstName']} '{$user['LastName']}'";
    } else {
        $_SESSION['delete-user-success'] = "{$user['FirstName']} {$user['LastName']} deleted successfully";
    }

}
header('location:' . ROOT_URL .'admin/manage-users.php');
die();