<?php
  session_start();

  $name = $_SESSION['admin']->name;
 ?>
<!-- start navbar-->
<nav class="bg-indigo-500">
  <div class="px-20">
    <div class="relative flex h-16 items-center justify-between">
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex flex-shrink-0 items-center">
            <h2 class="text-white font-mono font-bold text-lg">BLOG</h2>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <!-- Profile dropdown -->
        <div class="relative ml-3">
          <div class="flex">
            <div class="text-white px-2 font-bold font-mono text-lg"><?= $name ?? 'Unknown' ?></div>
            <div class="w-1 bg-white"></div> 
            <div class="px-2"><button class="text-red-700 font-mono text-lg">
              <form action="../../actions/admin/auth/Logout.php">
                <input class="cursor-pointer" type="submit" value="Logout">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</nav>

<!-- End navbar-->
