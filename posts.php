<?php
include 'partials/header.php';

// fetch post from database if id is set 
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}
?>

     <section class="singlepost">
        <div class="container singlepost__container">
            <h2><?= $post['title'] ?></h2>
            <div class="post__author">
                    <?php
                    // fetch author from users table using author_id
                    $author_id = $post['author_id'];
                    $author_query = "SELECT * FROM users WHERE Id=$author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);
                    ?>
                        <div class="post__author-avatar">
                            <img src="./image/<?= $author['Avatar'] ?>" alt="">
                        </div>
                        <div class="post_author-info">
                            <h5>By: <?= "{$author['FirstName']} {$author['LastName']}" ?></h5>
                            <small>
                            <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                            </small>
                        </div>
            </div>
            <div class="singlepost__thumbnail">
                <img src="./image/<?= $post['thumbnail'] ?>" alt="">
            </div>
            <p>
                <?= $post['body'] ?>
            </p>
        </div>
     </section>

     <!--END OF SINGLE POST-->


    <footer>
        <div class="footer__socials">
            <a href="https://www.youtube.com/" target="_blank">
                <i class="uil uil-youtube"></i>
            </a>
            <a href="https://www.facebook.com/" target="_blank">
                <i class="uil uil-facebook-f"></i>
            </a>
            <a href="https://www.twitter.com/" target="_blank">
                <i class="uil uil-twitter"></i>
            </a>
            <a href="https://www.instagram.com/" target="_blank">
                <i class="uil uil-instagram-alt"></i>
            </a>
            
        </div>
        <div class="container footer__container">
            <article>
                <h4>Categories</h4>
                <ul>
                    <li><a href="">Model</a></li>
                    <li><a href="">Actor</a></li>
                    <li><a href="">Singer</a></li>
                </ul>
            </article>
            <article>
                <h4>Blog</h4>
                <ul>
                    <li><a href="">Popular</a></li>
                    <li><a href="">Recent</a></li>
                    <li><a href="">Categories</a></li>
                </ul>
            </article>
            <article>
                <h4>Support</h4>
                <ul>
                    <li><a href="">Online Support</a></li>
                    <li><a href="">Emails</a></li>
                    <li><a href="">Call Numbers</a></li>
                </ul>
            </article>
            <article>
                <h4>Permalinks</h4>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            </article>
        </div>
        <div class="footer__copyright">
            <small>Copyright &copy; THIS IS MH WORKS</small>
        </div>
    </footer>


    <script src="./main.js"></script>
</body>
</html>