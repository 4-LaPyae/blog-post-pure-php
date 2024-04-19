<?php
include(__DIR__ . '/./vendor/autoload.php');

use database\model\CommentTable;
use database\model\PostTable;
use helpers\Helper;

$post_id = $_GET['id'];
if (!$post_id) {
    echo "There is no post.";
    exit;
}

$postTable = new PostTable();
$commentTable = new CommentTable();

$post = $postTable->findById($post_id);
$comments = $commentTable->index($post['id']);
// echo '<pre>';
// var_dump($comments);
// echo '</pre>';
if (!isset($post)) {
    echo "There is no post.";
    exit;
}
include("./layout/user/header.php");
include("./layout/user/Navbar.php");

?>
<!-- Container for demo purpose -->
<div class="container my-10 mx-auto md:px-6 ">
    <!-- Section: Design Block -->
    <section class="mb-10">
        <img src="<?= $post['image_path'] ?>" class="mb-6 w-1/4 rounded-lg shadow-lg dark:shadow-black/20" alt="image" />
        <div class="mb-6 flex items-center">
            <div>
                 By
                <span  class="font-bold font-mono"><?= $post['postBy'] ?></span>
            </div>
        </div>
        <div class="p-2">
          <span class="inline-flex rounded-md bg-pink-50 px-2 py-1 text-base font-medium text-pink-700 ring-1 ring-inset ring-pink-700/10"><?= $post['category'] ?></span>
        </div>
        <div class="p-2">
        <?php foreach (Helper::strToArr($post['tags']) as $key => $tag) : ?>  
          <span class="inline-flex rounded-md bg-sky-50 px-3 py-2 text-base font-medium text-black ring-1 ring-inset ring-pink-700/10"><?= $tag ?></span>
          <?php endforeach; ?>
          </div>
        <h1 class="mb-6 text-3xl font-bold">
            <?= $post['title'] ?>
        </h1>

        <p>
            <?= $post['description'] ?>
        </p>
    </section>
    <!-- Section: Design Block -->
</div>
<form action="./actions/user/comment/CreateComment.php" method="post">
    <div class="container my-10 mx-auto md:px-6">
        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
        <textarea class="resize rounded-md w-full border-red-500 px-2" placeholder="Comment Here..." name="text"></textarea>
        <button class="btn mt-2 bg-green-800 px-7 py-2 text-white rounded-md" type="submit">Submit</button>

        <div class="my-10">
            <?php foreach ($comments as $key => $comment) : ?>
                <div class="bg-white rounded-lg p-4 shadow-md my-3">
                    <div class="flex items-start">

                        <div>
                            <h3 class="font-bold text-lg"><?= $comment->commentBy ?></h3>
                            <p class="text-gray-600 text-sm">Posted on <?= $comment->created_at ?></p>
                            <p class="mt-2"><?= $comment->text ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>
</form>

<!-- Container for demo purpose -->
<?php

include("./layout/user/footer.php");


?>