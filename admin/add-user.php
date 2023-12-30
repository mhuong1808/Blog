<?php
include 'partials/header.php';

// get back form data if there was an error
$FirstName = $_SESSION['add-user-data']['FirstName'] ?? null;
$LastName = $_SESSION['add-user-data']['LaststName'] ?? null;
$UserName = $_SESSION['add-user-data']['UserName'] ?? null;
$Email = $_SESSION['add-user-data']['Email'] ?? null;
$CreatPassword = $_SESSION['add-user-data']['CreatPassword'] ?? null;
$ConfirmPassword = $_SESSION['add-user-data']['ConfirmPassword'] ?? null;



// delete session data
unset($_SESSION['add-user-data']);
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add User</h2>
        <?php if(isset($_SESSION['add-user'])) : ?>
            <div class="alert__message error">
            <p>
                <?= $_SESSION['add-user'];
                unset($_SESSION['add-user']);
                ?>
            </p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="FirstName" value="<?= $FirstName ?>" placeholder="First Name">
            <input type="text" name="LastName" value="<?= $LastName ?>" placeholder="Last Name">
            <input type="text" name="UserName" value="<?= $UserName ?>" placeholder="User Name">
            <input type="email" name="Email" value="<?= $Email ?>" placeholder="Email">
            <input type="password" name="CreatPassword" value="<?= $CreatPassword ?>" placeholder="Creat Password">
            <input type="password" name="ConfirmPassword" value="<?= $ConfirmPassword ?>" placeholder="Confirm Password">
            <select name="userrole" id="">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <div class="form__control">
                <label for="avatar">User Avatar</label>
                <input type="file" name="Avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Add User</button>
            </small>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php';
?>