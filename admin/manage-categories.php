<?php
include 'partials/header.php';

// fetch categories from database
$query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $query);
?>

<section class="dashboard">

    <?php if(isset($_SESSION['add-category-success'])) : // show if add category was successful ?>
            <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-category-success'];
                unset($_SESSION['add-category-success']);
                ?>
            </p>
            </div>
    <?php elseif(isset($_SESSION['add-category'])) : // show if add category was failed ?>
            <div class="alert__message error container">
            <p>
                <?= $_SESSION['add-category'];
                unset($_SESSION['add-category']);
                ?>
            </p>
            </div>
    <?php elseif(isset($_SESSION['edit-category'])) : // show if edit category was failed ?>
            <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-category'];
                unset($_SESSION['edit-category']);
                ?>
            </p>
            </div>
    <?php elseif(isset($_SESSION['edit-category-success'])) : // show if edit category was successful ?>
            <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-category-success'];
                unset($_SESSION['edit-category-success']);
                ?>
            </p>
            </div>
    <?php elseif(isset($_SESSION['delete-category-success'])) : // show if delete category was successful ?>
            <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-category-success'];
                unset($_SESSION['delete-category-success']);
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
                        <a href="manage-users.php" ><i class="uil uil-user-exclamation"></i></i>
                            <h5>Manage User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php"><i class="uil uil-file-landscape-alt"></i></i>
                            <h5>Add Category</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php" class="active"><i class="uil uil-files-landscapes-alt"></i></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                    <?php endif ?>
                </ul>
            </aside>
            <main>
                <h2>Manage Categories</h2>
                <?php if(mysqli_num_rows($categories) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                         <tr>
                           <td><?= $category['title'] ?></td>
                           <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>" class="btn sm">Edit</a></td>
                           <td><a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>" class="btn sm danger">Delete</a></td>
                         </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
                <?php else : ?>
                    <div class="alert__message error"><?="No categories found!"?></div>
                <?php endif ?>
            </main>
        </div>
    </section>

<?php
include '../partials/footer.php'
?>