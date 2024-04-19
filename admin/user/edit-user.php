<?php

use helpers\FLUSH;

include_once("../../vendor/autoload.php");
include("../../layout/admin/header.php");
include("../../layout/admin/navbar.php");
include("../../layout/admin/sidebar.php");

use database\model\UserTable;

$id = $_GET['id'];
$userTable = new UserTable();
$user = $userTable->findById($id);

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
            <li class=""><a href="../../admin/user/user.php">Users</a></li>
            <li>
                <span class="mx-2 text-neutral-500 dark:text-neutral-400">></span>
            </li>
            <li class=" text-neutral-500 dark:text-neutral-400"><a>edit-user</a></li>
        </ol>
    </nav>

    <div class="p-3 w-2/4 flex justify-center mt-5 bg-slate-100">
        <form action="../../actions/admin/user/UpdateUser.php" method="POST">
            <input type="hidden" name="id" value="<?= $user[0]->id ?>">

            <div class="space-y-12">
                <div class="pb-12">
                    <h2 class="text-base text-lg font-bold font-mono leading-7 text-gray-900"><?= $user[0]->name ?>'s Information</h2>
                    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name*</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" placeholder="enter name" value="<?= $user[0]->name ?? "" ?>" disabled class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email*</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" placeholder="enter email" value="<?= $user[0]->email ?? "" ?>" disabled class="block w-full px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password*</label>
                            <div class="mt-2">
                                <input type="text" name="password" id="password" placeholder="enter password" value="******" disabled class="block w-full px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="role_id" class="block text-sm font-medium leading-6 text-gray-900">Role*</label>
                            <div class="mt-2">
                                <select id="role_id" name="role_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option <?= $user[0]->role_id == 2 ? "selected" : "" ?> value="user">User</option>
                                    <option <?= $user[0]->role_id == 1 ? "selected" : "" ?> value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status*</label>
                            <div class="mt-2">
                                <select id="status" name="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option <?= $user[0]->status == 1 ? "selected" : "" ?> value="active">Active</option>
                                    <option <?= $user[0]->status == 0 ? "selected" : "" ?> value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (FLUSH::check('error')) : ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mt-5" role="alert">
                    <p><?= FLUSH::message('error') ?></p>
                </div>
            <?php endif; ?>
            <div class="mt-6 flex items-center justify-center gap-x-6">
                <button type="submit" class="rounded-md bg-indigo-600 px-6 py-2 text-lg font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
            </div>
        </form>


    </div>
</div>
<?php include("../../layout/admin/footer.php") ?>