<?php
include 'partials/header.php';

//fetch user from database but not current user that logged in now
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users WHERE NOT id=$current_admin_id";
$users = mysqli_query($connection, $query);
?>

<section class="dashboard">
    <?php if(isset($_SESSION['add-user-success'])) : // show if add user was successful ?>
            <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-user-success'];
                unset($_SESSION['add-user-success']);
                ?>
            </p>
            </div>
    <?php elseif(isset($_SESSION['edit-user-success'])) : // show if edit user was successful ?>
            <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-user-success'];
                unset($_SESSION['edit-user-success']);
                ?>
            </p>
            </div>
    <?php elseif(isset($_SESSION['edit-user'])) : // show if edit user was failed ?>
            <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-user'];
                unset($_SESSION['edit-user']);
                ?>
            </p>
            </div>
    <?php elseif(isset($_SESSION['delete-user'])) : // show if delete user was failed ?>
            <div class="alert__message error container">
            <p>
                <?= $_SESSION['delete-user'];
                unset($_SESSION['delete-user']);
                ?>
            </p>
            </div>
    <?php elseif(isset($_SESSION['delete-user-success'])) : // show if edit user was successful ?>
            <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-user-success'];
                unset($_SESSION['delete-user-success']); 
                ?>
            </p>
            </div>
    <?php endif ?>

        <div class="container dashboard__container">
            <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-double-right"></i></button>
            <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-double-left"></i></button>
            <aside>
                <ul>
                    <li>
                        <a href="add-post.php"><i class="uil uil-edit-alt"></i>
                            <h5>Add Post</h5>
                        </a>
                    </li>
                    <li>
                        <a href="index.php"><i class="uil uil-edit"></i>
                            <h5>Manage Post</h5>
                        </a>
                    </li>

                    <?php if (isset($_SESSION['User_Is_Admin'])) : ?>
                    <li>
                        <a href="add-user.php"><i class="uil uil-user-plus"></i></i>
                            <h5>Add User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-users.php" class="active"><i class="uil uil-user-exclamation"></i></i>
                            <h5>Manage User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php"><i class="uil uil-file-landscape-alt"></i></i>
                            <h5>Add Category</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php"><i class="uil uil-files-landscapes-alt"></i></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                    <?php endif ?>
                </ul>
            </aside>
            <main>
                <h2>Manage User</h2>
                <?php if(mysqli_num_rows($users) > 0 ) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($user = mysqli_fetch_assoc($users)) : ?>
                        <tr>
                            <td><?= "{$user['FirstName']} {$user['LastName']}" ?></td>
                            <td><?= $user['UserName'] ?></td>
                            <td><a href="<?=ROOT_URL ?>admin/edit-users.php?id=<?= $user['Id'] ?>" class="btn sm">Edit</a></td>
                            <td><a href="<?=ROOT_URL ?>admin/delete-users.php?id=<?= $user['Id'] ?>" class="btn sm danger">Delete</a></td>
                            <td><?= $user['Is_Admin'] ? 'Yes': 'No' ?></td>
                        </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
                <?php else : ?>
                    <div class="alert__message error"><?= "No users found!" ?></div>
                <?php endif ?>
            </main>
        </div>
    </section>

<?php
include '../partials/footer.php'
?>