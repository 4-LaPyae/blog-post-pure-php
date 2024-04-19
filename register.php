<?php
session_start();
use helpers\FLUSH;

include("./vendor/autoload.php");

include("./layout/user/header.php")

?>
<!-- component -->
<section class="py-26 bg-white">
  <div class="container px-4 mx-auto">
    <div class="max-w-lg mx-auto">
      <div class="text-center mb-8">
        <a class="inline-block mx-auto mb-6" href="#">
          <img src="nigodo-assets/logo-icon-nigodo.svg" alt="">
        </a>
        <h2 class="text-3xl md:text-4xl font-extrabold mb-2">Register</h2>
      </div>
      <form action="./actions/user/auth/Register.php" method="POST">
        <div class="mb-6">
          <label class="block mb-2 font-extrabold" for="">Name</label>
          <input class="inline-block w-full p-4 leading-6 text-lg font-extrabold placeholder-indigo-900 bg-white shadow border-2 border-indigo-900 rounded" type="text" name="name" placeholder="name">
        </div>
        <div class="mb-6">
          <label class="block mb-2 font-extrabold" for="">Email</label>
          <input class="inline-block w-full p-4 leading-6 text-lg font-extrabold placeholder-indigo-900 bg-white shadow border-2 border-indigo-900 rounded" type="email" name="email" placeholder="email">
        </div>
        <div class="mb-6">
          <label class="block mb-2 font-extrabold" for="">Password</label>
          <input class="inline-block w-full p-4 leading-6 text-lg font-extrabold placeholder-indigo-900 bg-white shadow border-2 border-indigo-900 rounded" type="password" name="password" placeholder="**********">
        </div>
        <!-- Error message -->
        <?php if (FLUSH::check('error')) : ?>
          <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mt-5" role="alert">
            <p><?= FLUSH::message('error') ?></p>
          </div>
        <?php endif; ?>
        <button type="submit" class="inline-block w-full py-4 px-6 mb-6 text-center text-lg leading-6 text-white font-extrabold bg-indigo-800 hover:bg-indigo-900 border-3 border-indigo-900 shadow rounded transition duration-200">Register</button>
      </form>
    </div>
  </div>
</section>
<?php
include("./layout/user/footer.php")
?>