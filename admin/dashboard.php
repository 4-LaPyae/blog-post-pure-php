<?php

use database\model\CategoryTable;
use database\model\PostTable;
use database\model\UserTable;
use helpers\AUTH;

include("../vendor/autoload.php");

AUTH::check('admin');
require("../../blog/layout/admin/header.php");
require("../../blog/layout/admin/navbar.php");
require("../../blog/layout/admin/sidebar.php");

$categoryTable = new CategoryTable();
$categoryTotal = $categoryTable->allCount();
$postTable = new PostTable();
$postTotal = $postTable->allCountPosts(1);
$postSuspendTotal = $postTable->allCountPosts(0);
$totalPosts = $postTotal + $postSuspendTotal;
$userTable = new UserTable();
$totalUsers = $userTable->allCount();
?>
<div class="w-full">
  <div class="flex my-2 py-5 flex-row justify-around w-3/4">
    <div class="block rounded-lg  text-center bg-indigo-100	 w-2/12 p-6 shadow-lg">
      <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
       Total Categories
      </h5>
      <p class="mb-4 text-lg text-red-700">
        <?= $categoryTotal ?? 0 ?>
      </p>
    </div>
    <div class="block rounded-lg  text-center bg-indigo-100 w-2/12 p-6 shadow-lg">
      <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
       Total Posts
      </h5>
      <p class="mb-4 text-lg text-red-700">
       <?= $totalPosts ?? 0?>
      </p>
      <p>Posts - <span class="px-2 text-red-700"><?= $postTotal ?? 0 ?></span></p>
      <p>Suspend Posts - <span class="px-2 text-red-700"><?= $postSuspendTotal ??  0 ?></span></p>

    </div>
    <div class="block rounded-lg  text-center bg-indigo-100 w-2/12 p-6 shadow-lg">
      <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
       Total Users
      </h5>
      <p class="mb-4 text-lg text-red-700">
      <?= $totalUsers ?? 0 ?>
      </p>
    </div>
  </div>
</div>
<?php
include("../../blog/layout/admin/footer.php");

?>