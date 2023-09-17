<script setup>
import { ref } from 'vue';

//to check if the user has shortened an url before
let didShortened = ref(false);
//to store the last sucessfully created short link
let shortLink = ref(null);
//long url model
let longLink = ref(null);

function createUrl(){
    didShortened.value = false;

    const requestOptions = {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' ,'accept': 'application/json'},
    body: JSON.stringify({url: longLink.value})
    };

    fetch('http://localhost:8000/api/urls', requestOptions)

    .then(response => {
         if (!response.ok) {
            throw new Error(response.status);
    }
    return response.json();
    })

    .then(data =>  {
        didShortened.value = true;
        shortLink.value = window.location.origin+'/'+data.short_url;

    })

    .catch(error => {
        console.error("There was an error!", error);
    });
}

function copyToClipboard() {
  if (shortLink.value) {
    navigator.clipboard.writeText(shortLink.value)
      .then(() => {
        console.log('Text copied to clipboard');
      })
      .catch(error => {
        console.error('Error copying text to clipboard:', error);
      });
  }
}
</script>

<template>

    <section class="flex  flex-col max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 md:flex-row md:h-48">
        <div class="md:flex md:items-center md:justify-center md:w-1/2 md:bg-gray-700 md:dark:bg-gray-800">
            <div class="px-6 py-6 md:px-8 md:py-0">
                <h2 class="text-lg font-bold text-gray-700 dark:text-white md:text-gray-100"><span class="text-blue-600 dark:text-blue-400 md:text-blue-300">Shortner</span> a long url </h2>

                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 md:text-gray-400">Our URL shortener is a convenient tool that transforms long URLs into concise and customized links. It simplifies the process of sharing links, making them more manageable for social media, emails, and other platforms where brevity is essential. With built-in analytics and robust security measures, our URL shortener empowers users to optimize their marketing campaigns while ensuring the safety of their links and users.</p>
            </div>
        </div>

        <div class="flex items-center justify-center pb-6 md:py-0 md:w-1/2">
            <form @submit.prevent="createUrl">
                <div class="flex flex-col p-1.5 overflow-hidden border rounded-lg dark:border-gray-600 lg:flex-row dark:focus-within:border-blue-300 focus-within:ring focus-within:ring-opacity-40 focus-within:border-blue-400 focus-within:ring-blue-300">

                <input type="text" name="url" v-model="longLink" class="px-6 py-2 text-gray-700 placeholder-gray-500 bg-white outline-none dark:bg-gray-800 dark:placeholder-gray-400 focus:placeholder-transparent dark:focus:placeholder-transparent" placeholder="Enter URL to shortener" aria-label="Enter URL to shortener">
                <button type="submit" name="shortener" class="px-4 py-3 text-sm font-medium tracking-wider text-gray-100 uppercase transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:bg-gray-600 focus:outline-none">shortener</button>
                </div>
            </form>
        </div>

    </section>


    <div  v-if="didShortened" class="w-96 p-4 m-auto bg-white shadow-lg rounded-2xl dark:bg-gray-800 mt-4">
        <div class="w-full h-full text-center">
            <div class="flex flex-col justify-between h-full">
                <svg class="w-12 h-12 m-auto mt-4 text-green-500" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                    </path>
                </svg>
                <p class="px-6 py-2 text-gray-600 dark:text-gray-100 text-md">
                    link
                    <span class="font-bold text-gray-800 dark:text-white">
                        {{shortLink}}
                    </span>
                    has been created successfully.
                </p>
                <div class="flex items-center justify-between w-full gap-4 mt-8">
                    <button @click="copyToClipboard" class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        copy
                    </button>
                </div>
            </div>
        </div>
    </div>


</template>

