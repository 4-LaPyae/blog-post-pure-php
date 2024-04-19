<?php

use database\model\PostTable;
use helpers\FLUSH;
use helpers\Helper;

include_once("../../vendor/autoload.php");
include("../../layout/admin/header.php");
include("../../layout/admin/navbar.php");
include("../../layout/admin/sidebar.php");

$postId = $_GET['id'] ?? NULL;
$postTable = new PostTable();
$post = $postTable->findById($postId);

?>
<div id="main-container" class="p-3 w-full">
  <nav class="bg-grey-light w-full rounded-md">
    <ol class="list-reset flex">
      <li>
        <a href="../../admin/dashboard.php" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Home</a>
      </li>
      <li>
        <span class="mx-2 text-neutral-500 dark:text-neutral-400">></span>
      </li>
      <li class=""><a href="../../admin/post/post.php">Posts</a></li>
      <li>
        <span class="mx-2 text-neutral-500 dark:text-neutral-400">></span>
      </li>
      <li class=" text-neutral-500 dark:text-neutral-400"><a><?= $post['title']  ?></a></li>
    </ol>
  </nav>
  <section class="p-3 justify-center align-center mt-5 bg-slate-100	">
    <div class="p-3">
      <img src="<?= $post['image_path'] ?>" class="mb-6 w-1/4 rounded-lg shadow-lg dark:shadow-black/20" />
      <div class="mb-6 flex items-center">
        <div>
          <span><u><?= Helper::myanmartTime($post['created_at']) ?></u> by </span>
          <a href="#!" class="font-bold font-mono"><?= $post['postBy'] ?></a>
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
      <div class="py-3">
        <?php if ($post['delete_status'] == 0) : ?>
          <form action="../../actions/admin/post/NoSuspenPost.php" method="post">
            <input type="hidden" name="post_id" id="post_id" value="<?= $post['id'] ?>">
            <button type="submit" class="px-3 py-2 bg-green-700 rounded text-white">No Suspend</button>
          </form><?php else : ?>
          <form action="../../actions/admin/post/SuspenPost.php" method="post">
            <input type="hidden" name="post_id" id="post_id" value="<?= $post['id'] ?>">
            <button type="submit" class="px-3 py-2 bg-red-700 rounded text-white"> Suspend</button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </section>
</div>
<!-- Container for demo purpose -->
<?php include("../../layout/admin/footer.php") ?>