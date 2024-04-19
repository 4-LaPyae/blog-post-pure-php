<?php

use helpers\AUTH;

include("./vendor/autoload.php");
session_start();
if (isset($_SESSION['user'])) {
    $name = $_SESSION['user']->name;
}
?>
<!-- Main navigation container -->
<nav class="relative sticky flex w-full flex-wrap items-center justify-between bg-indigo-500 py-2 text-neutral-500 shadow-md sticky-nav" data-te-navbar-ref>
    <div class="flex w-full flex-wrap items-center justify-between px-40 py-3">
        <!-- Collapsible navbar container -->
        <div class="!visible mt-2 hidden flex-grow basis-[100%] items-center lg:mt-0 lg:!flex lg:basis-auto" id="navbarSupportedContent4" data-te-collapse-item>
            <!-- Left links -->
            <ul class="list-style-none mr-auto flex flex-col pl-0 lg:mt-1 lg:flex-row" data-te-navbar-nav-ref>
                <!-- Home link -->
                <li class="my-4 pl-2 lg:my-0 lg:pl-2 lg:pr-1" data-te-nav-item-ref>
                    <div class="font-mono text-white font-bold text-lg">Blog</div>
                </li>
            </ul>

            <div class="flex items-center">
            <div class="mx-3"> 
                        <button type="button" class="inline-flex items-center rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-sky-700">
                            <a href="../../../blog/index.php">
                            Home
                            </a>
                        </button>
                    </div>
                    <?php if (AUTH::valid('user')) : ?>
                        <button type="button" class="inline-flex items-center rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-sky-700">
                      <a href="../../../blog/mypost.php">
                     My Posts
                      </a>  
                    </button>
                <?php endif; ?>
                <?php if (!AUTH::valid('user')) : ?>
                    <button type="button" data-te-ripple-init data-te-ripple-color="light" class="mr-3 inline-block rounded px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-neutral-100 hover:text-black focus:text-primary-600 focus:outline-none focus:ring-0 active:text-primary-700 motion-reduce:transition-none">
                    <a class="" href="../../../blog/login.php">Login</a>
                    </button>
                    <button type="button" data-te-ripple-init data-te-ripple-color="light" class="mr-3 inline-block bg-red-700 rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                      <a href="../../../blog/register.php">
                      Sign up for free
                      </a>  
                    </button>
                <?php endif; ?>
                <?php if (AUTH::valid('user')) : ?>
                    <div class="mx-3"> 
                        <button type="button" class="inline-flex items-center rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-sky-700">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                            </svg>
                            <a href="../../../blog/create-post.php">
                            Create Post

                            </a>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="">
                    <div class="font-mono text-white font-bold text-xl"> <?= $name ?? 'Unknown' ?></div>
                </div> 
                <div class="w-1 h-5 bg-stone-500 mx-2"></div> 

                <?php if (AUTH::valid('user')) : ?>
                    <form action="../../../blog/actions/user/auth/Logout.php" method="POST">
                        <input type="submit" value="Logout" class="text-red-500 cursor-pointer px-2 font-bold font-mono">
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>