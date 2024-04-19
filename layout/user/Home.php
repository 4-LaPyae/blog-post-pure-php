<?php

use database\model\PostTable;
use helpers\Helper;

include(__DIR__ . "/../../vendor/autoload.php");
$postTable = new PostTable();
$posts = $postTable->index();
?>
<div class="px-40 mx-auto">
  <div class="flex justify-center items-center flex-col mt-5">
    <?php foreach ($posts as $key => $post) : ?>
      <div class="block w-2/6 mt-2 rounded-lg bg-slate-100">
        <h5 class="mt-2 text-xl text-center px-2 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
          <?= $post->title ?>
        </h5>
        <div class="p-2 text-center">
          <span class="inline-flex items-center rounded-md bg-pink-50 px-2 py-1 text-base font-medium text-pink-700 ring-1 ring-inset ring-pink-700/10"><?= $post->category ?></span>
        </div>
        <div class="p-2 text-center">
        <?php foreach (Helper::strToArr($post->tags) as $key => $tag) : ?>  
          <span class="inline-flex items-center rounded-md bg-sky-50 px-3 py-2 text-base font-medium text-black ring-1 ring-inset ring-pink-700/10"><?= $tag ?></span>
          <?php endforeach; ?>
          </div>

        <div class="bg-cover bg-no-repeat flex justify-center" data-te-ripple-init data-te-ripple-color="light">
          <img class="rounded-t-lg" src="<?= $post->image_path ?>" alt="" style="width: 500px;" />
        </div>

        <div class="p-6 text-center">
          <div class="flex flex-row justify-around">
          <span class="text-gray-500"><?= Helper::myanmartTime($post->created_at) ?></span>
          <span class="font-blod font-mono text-lg">By <?= $post->user ?? 'Unknown' ?></span>
          <span></span>
          </div>
          <p class="mb-4 mt-2  text-base text-neutral-600 dark:text-neutral-200">
            <?= $post->description ?>
          </p>
          <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
          <button type="button" class="inline-block rounded bg-sky-500 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white"><a href="../../../blog/post-detail.php?id=<?= $post->id ?>">View</a></button>
        </div>
      </div>

    <?php endforeach; ?>
  </div>

</div>