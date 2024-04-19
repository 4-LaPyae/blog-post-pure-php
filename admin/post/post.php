<?php

use database\model\PostTable;
use helpers\FLUSH;

include_once("../../vendor/autoload.php");
include("../../layout/admin/header.php");
include("../../layout/admin/navbar.php");
include("../../layout/admin/sidebar.php");

$postTable = new PostTable();
$posts = $postTable->indexAdmin();

?>
<div id="main-container" class="p-3 w-full">
    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    <nav class="bg-grey-light w-full rounded-md">
        <ol class="list-reset flex">
            <li>
                <a href="../../admin//dashboard.php" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Home</a>
            </li>
            <li>
                <span class="mx-2 text-neutral-500 dark:text-neutral-400">></span>
            </li>
            <li class="text-neutral-500 dark:text-neutral-400">Posts</li>
        </ol>
    </nav>

    <div class="p-3">
        <!-- component -->
        <div class="text-gray-900 bg-gray-200">
            <div class="p-4 flex">
                <h1 class="text-3xl">Users Lists</h1>
                <?php if (FLUSH::check('success')) : ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mt-5" role="alert">
                        <p><?= FLUSH::message('success') ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="px-3 py-4 flex justify-center w-full">
                <table class="w-full text-md bg-white shadow-md rounded mb-4">
                    <tbody>
                        <tr class="border-b">
                            <th class="text-center p-3 px-5">#</th>
                            <th class="text-left p-3 px-5">Title</th>
                            <th class="text-left p-3 px-5">Category</th>
                            <th class="text-left p-3 px-5">Owner</th>
                            <th class="text-left p-3 px-5">Created At</th>
                            <th class="text-center p-3 px-5">Action</th>
                        </tr>

                        <?php foreach ($posts as $key => $post) : ?>
                            <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                <th><?= $key + 1 ?></th>

                                <td class="p-3 px-5">
                                    <div class="flex">
                                        <div><?= $post->title ?> </div>
                                        <?php if ($post->delete_status == 0) { ?>
                                            <div class="w-2 h-2 bg-red-700 rounded-full"></div>
                                        <?php } ?>

                                    </div>

                                </td>
                                <td class="p-3 px-5">
                                    <?= $post->category ?>
                                </td>
                                <td class="p-3 px-5">
                                    <?= $post->user ?>
                                </td>
                                <td class="p-3 px-5">
                                    <?= $post->created_at ?>
                                </td>
                                <td class="p-3 px-5 flex justify-center">
                                    <button type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"><a href="../../admin/post/post-detail.php?id=<?= $post->id ?>">details</a></button>
                                    <form action="../../actions/admin/post/DeletePost.php" method="post">
                                        <input type="hidden" id="post_id" name="post_id" value="<?= $post->id ?>">
                                        <button type="submit" class="mr-3 text-sm bg-red-500 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include("../../layout/admin/footer.php") ?>