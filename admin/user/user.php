<?php
session_start();
use helpers\AUTH;

include_once("../../vendor/autoload.php");
AUTH::check('admin');
include("../../layout/admin/header.php");
include("../../layout/admin/navbar.php");
include("../../layout/admin/sidebar.php");

use database\model\UserTable;
use helpers\FLUSH;
$usersTables = new UserTable();
$users = $usersTables->index();
//if(isset($_SESSION['user'])){
    $id = $_SESSION['user']->id;
//not get login users1
$result = array_map(function ($data) use ($id){
    if( $data->id != $id){
        return $data;
    };
}, $users);
//remove null vlaue
$newReults = array_filter($result, function ($value) {
    return $value !== NULL;
});

//}else{
   // echo 'ma shi buu';
//}
?>
<div id="main-container" class="p-3 w-full">
    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
    <nav class="bg-grey-light w-full rounded-md">
        <ol class="list-reset flex">
            <li>
                <a href="../../admin/dashboard.php" class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">Home</a>
            </li>
            <li>
                <span class="mx-2 text-neutral-500 dark:text-neutral-400">></span>
            </li>
            <li class="text-neutral-500 dark:text-neutral-400">Users</li>
        </ol>
    </nav>

    <div class="p-3">
        <!-- component -->
        <div class="text-gray-900 bg-gray-200">
            <div class="p-4 flex">
                <h1 class="text-3xl">Users Lists</h1>
                <?php if (FLUSH::check('success')) : ?>
        <div class="bg-red-100 border-l-4 border-green-500 text-white p-2 mt-5" role="alert">
          <p><?= FLUSH::message('success') ?></p>
        </div>
      <?php endif; ?>
            </div>
            <div class="px-3 py-4 flex justify-center w-full">
                <table class="w-full text-md bg-white shadow-md rounded mb-4">
                    <tbody>
                        <tr class="border-b">
                            <th class="text-center p-3 px-5">#</th>
                            <th class="text-left p-3 px-5">Name</th>
                            <th class="text-left p-3 px-5">Email</th>
                            <th class="text-left p-3 px-5">Role</th>
                            <th class="text-left p-3 px-5">Active</th>
                            <th class="text-center p-3 px-5">Action</th>
                        </tr>
                        <?php foreach ($newReults as $key => $user) : ?>
                            <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                <th><?= $key +1?></th>
                                <td class="p-3 px-5">
                                    <?= $user->name ?>
                                </td>
                                <td class="p-3 px-5">
                                    <?= $user->email ?>
                                </td>
                                <td class="p-3 px-5">
                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-500 text-white"> <?= $user->role ?>
                                    </span>
                                </td>
                                <td class="p-3 px-5">
                                    <?= $user->status === 1 ? '<p class="text-green-500">active</p>' : '<p class="text-red-500">inactive</p>' ?>
                                </td>
                                <td class="p-3 px-5 flex justify-center">
                                    <button type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"><a href="../../admin/user/edit-user.php?id=<?= $user->id ?>">Edit</a></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<?php include("../../layout/admin/footer.php") ?>