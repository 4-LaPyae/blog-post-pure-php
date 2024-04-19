<?php

use database\model\CategoryTable;
use helpers\FLUSH;

include("./vendor/autoload.php");
include("./layout/user/header.php");
include("./layout/user/Navbar.php");

$categoryTable = new CategoryTable();
$categories = $categoryTable->index();
?>
<div class="flex justify-center w-full">
  <div class="bg-gray-100 py-5 px-10 mt-3">
    <form  action="./actions/user/post/CreatePost.php" method="post" enctype="multipart/form-data">
      <div class="mt-5 ">
        <div class="">
          <h2 class="text-2xl text-center font-semibold leading-7 text-gray-900">Create Post</h2>
          <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>

          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="col-span-full">
              <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Post title</label>
              <div class="mt-2">
                <input type="text" name="title" id="title" autocomplete="given-name" class=" w-full rounded-md px-2 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>

            <div class="col-span-full">
              <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Post Desciption</label>
              <div class="mt-2">
                <textarea id="about" name="description" id="description" rows="4" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
              </div>
              <p class="mt-3 text-sm leading-6 text-gray-600">Write description about post.</p>
            </div>
            <div class="col-span-full">
              <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
              <div class="mt-2">
                <select id="category_id" name="category_id" autocomplete="category-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-md">
                  <?php foreach ($categories as $key => $category) : ?>
                    <option value="<?= $category->id ?>"><?= $category->title ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-span-full">
              <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">photo</label>
              <div class="mt-2 mb-3">
                <input class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary" name="file" type="file" id="file" />
              </div>
            </div>
          </div>
        </div>
        <!-- start tag section -->
        <div x-data @tags-update="console.log('tags updated', $event.detail.tags)" data-tags='["php","javascript"]' class="">
          <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Tags</label>
          <div x-data="tagSelect()" x-init="init('parentEl')" @click.away="clearSearch()" @keydown.escape="clearSearch()" class="mt-2">
            <div class="relative" @keydown.enter.prevent="addTag(textInput)">
              <!-- hidden input for tags  -->
              <input type="hidden" name="tags" x-model="tags">

              <input x-model="textInput" x-ref="textInput" @input="search($event.target.value)" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter some tags">
              <div :class="[open ? 'block' : 'hidden']">
                <div class="absolute z-40 left-0 mt-2 w-full">
                  <div class="py-1 text-sm bg-white rounded shadow-lg border border-gray-300">
                    <a @click.prevent="addTag(textInput)" class="block py-1 px-5 cursor-pointer hover:bg-indigo-600 hover:text-white">Add tag "<span class="font-semibold" x-text="textInput"></span>"</a>
                    <hr>
                    <div id="result-tags">
                      <!-- existing tags will be here  -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- selections -->
              <template x-for="(tag, index) in tags">
                <div class="bg-indigo-100 inline-flex items-center text-sm rounded mt-2 mr-1">
                  <span class="ml-2 mr-1 leading-relaxed truncate max-w-xs" x-text="tag"></span>
                  <button @click.prevent="removeTag(index)" class="w-6 h-8 inline-block align-middle text-gray-500 hover:text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6 fill-current mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path fill-rule="evenodd" d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z" />
                    </svg>
                  </button>
                </div>
              </template>
            </div>
          </div>
        </div>
         <!-- Error message -->
      <?php if (FLUSH::check('error')) : ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mt-5" role="alert">
          <p><?= FLUSH::message('error') ?></p>
        </div>
      <?php endif; ?>
        <!-- end tag section -->
        <div class="mt-6 py-3 flex flex-row items-center justify-center">
          <button type="submit" class="rounded-md bg-green-500 px-5 py-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
      </div>

    </form>

  </div>
  <!-- end  -->

</div>
<?php
include("./layout/user/footer.php")
?>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script>
  function tagSelect() {
    return {
      open: false,
      textInput: '',
      tags: [],
      init() {
        this.tags = JSON.parse(this.$el.parentNode.getAttribute('data-tags'));
      },
      addTag(tag) {
        tag = tag.trim();
        if (tag !== "" && !this.hasTag(tag)) {
          this.tags.push(tag);
        }
        this.clearSearch();
        this.$refs.textInput.focus();
        this.fireTagsUpdateEvent();
      },
      fireTagsUpdateEvent() {
        this.$el.dispatchEvent(new CustomEvent('tags-update', {
          detail: {
            tags: this.tags
          },
          bubbles: true,
        }));
      },
      hasTag(tag) {
        console.log('tag',tag)
        return this.tags.some(e => e.toLowerCase() === tag.toLowerCase());
      },
      removeTag(index) {
        this.tags.splice(index, 1);
        this.fireTagsUpdateEvent();
      },
      search(q) {
        this.searchByAJAX(q);
        if (q.includes(",")) {
          q.split(",").forEach(val => {
            this.addTag(val);
          });
        }
        this.toggleSearch();
      },
      clearSearch() {
        this.textInput = '';
        this.toggleSearch();
      },
      toggleSearch() {
        this.open = this.textInput !== '';
      },
      async searchByAJAX(val) {
        try {
          const response = await fetch(`http://localhost/blog/actions/admin/tag/Tags.php?name=${val}`);
          if (response.ok) {
            const data = await response.json();
            this.updateResultTags(data);
          } else {
            console.error(`Error: ${response.status} - ${response.statusText}`);
          }
        } catch (error) {
          console.error('Error:', error);
        }
      },
      updateResultTags(data) {
        const resultTags = document.getElementById('result-tags');
        resultTags.innerHTML = '';
        data.forEach(element => {
          const tagElement = document.createElement('a');
          tagElement.classList.add('block', 'py-1', 'px-5', 'cursor-pointer', 'hover:bg-indigo-600', 'hover:text-white');
          tagElement.innerHTML = `<span class="font-semibold">${element.name}</span>`;
          tagElement.addEventListener('click', () => this.addTag(element.name));
          resultTags.appendChild(tagElement);
        });
      }
      
    };
  }
  
</script>