<script setup>
import { ref , watch} from 'vue';

let urls = ref(null);
let byPopularity = ref(false);
//retrive urls from the api by date
fetch('http://localhost:8000/api/urls').then(response => response.json())
    .then(data => urls.value = data);

watch(byPopularity, (newValue) => {
    if (!newValue) {
        fetch('http://localhost:8000/api/urls')
        .then(response => response.json())
        .then(data => {
            urls.value = data;
        });
    } else {
        fetch('http://localhost:8000/api/urls/most-visited')
        .then(response => response.json())
        .then(data => {
            urls.value = data;
        });
    }
});
</script>

<template>
<div class="mx-16">
    <div v-if="byPopularity">
        <h2  class="mt-4 text-lg font-medium sm:text-xl mb-4">Most Visited shortened URLs:</h2>
        <button @click="byPopularity=!byPopularity" class="mb-8 px-6 py-2  transition ease-in duration-200 uppercase rounded-full hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none">
        Sort by latest
        </button>
    </div>

    <div v-else>
        <h2  class="mt-4 text-lg font-medium sm:text-xl mb-4">Latest shortened URLs:</h2>
        <button @click="byPopularity=!byPopularity" class="mb-8 px-6 py-2  transition ease-in duration-200 uppercase rounded-full hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none">
            Sort by popular
        </button>
    </div>

    <table class="table p-4 bg-white rounded-lg shadow">
        <thead>
            <tr>
                <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                    #
                </th>
                <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                    Short url
                </th>
                <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                    Long url
                </th>
                <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                    Visit count
                </th>
            </tr>
        </thead>

        <tbody>
            <tr class="text-gray-700" v-for="url in urls" :key="url.id">
                <td class="border p-4 dark:border-dark-5">
                    {{url.id}}
                </td>
                <td class="border p-4 dark:border-dark-5 text-blue-600">
                    <router-link :to="url.short_url">http://localhost:5173/{{url.short_url}}</router-link>
                </td>
                <td class="border p-4 dark:border-dark-5 text-blue-600">
                    <a :href="url.long_url">{{url.long_url}}</a>
                </td>
                <td class="border p-4 dark:border-dark-5 text-indigo-600">
                    {{url.click_count}}
                </td>

            </tr>
        </tbody>
    </table>
</div>
</template>
