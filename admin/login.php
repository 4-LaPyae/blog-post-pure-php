<?php
require_once '../vendor/autoload.php';

use helpers\FLUSH;

session_start();

// Unset the session data
unset($_SESSION['admin']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <!-- Include Tailwind CSS -->
  <?php include("../header_links.php") ?>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

  <div class="bg-white p-8 rounded shadow-md w-96">

    <h2 class="text-2xl font-semibold mb-6 flex justify-center">Admin Login</h2>

    <!-- Login Form -->
    <form action="../actions/admin/auth/Login.php" method="POST">

      <!-- Email Input -->
      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
        <div class="mt-2">
          <input id="email" name="email" type="email" placeholder="enter eamil" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <!-- Password Input -->
      <div class="mt-2">
        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
        <div class="mt-2">
          <input id="password" name="password" type="password" placeholder="enter password" class="block w-full px-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>
      <!-- Error message -->
      <?php if (FLUSH::check('error')) : ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mt-5" role="alert">
          <p><?= FLUSH::message('error') ?></p>
        </div>
      <?php endif; ?>


      <!-- Submit Button -->
      <div class="my-4">
        <button type="submit" class="w-full bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring focus:border-indigo-300">
          Login
        </button>
      </div>

    </form>
    <!-- End of Login Form -->

  </div>

</body>

</html>