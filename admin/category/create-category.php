<?php

use helpers\FLUSH;

include_once("../../vendor/autoload.php");
include("../../layout/admin/header.php");
include("../../layout/admin/navbar.php");
include("../../layout/admin/sidebar.php");


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
            <li class=""><a href="../../admin/category/category.php">Categories</a></li>
            <li>
                <span class="mx-2 text-neutral-500 dark:text-neutral-400">></span>
            </li>
            <li class=" text-neutral-500 dark:text-neutral-400"><a>create-category</a></li>
        </ol>
    </nav>

    <div class="p-3 w-1/5 justify-center align-center mt-5 bg-slate-100	">
        <form action="../../actions/admin/category/CreateCategory.php" method="POST">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <div class="mt-5">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Category Name*</label>
                            <div class="mt-2">
                                <input type="text" name="title" id="title" placeholder="enter category name" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <?php if (FLUSH::check('error')) : ?>
                            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mt-5" role="alert">
                             ''    <p><?= FLUSH::message('error') ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-center gap-x-6">
                <button type="submit" class="rounded-md bg-indigo-600 px-6 py-2 text-lg font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </form>


    </div>
</div>
<?php include("../../layout/admin/footer.php") ?>