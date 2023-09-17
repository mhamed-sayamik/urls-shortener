<script setup>
    import {  useRoute } from 'vue-router'
    const route = useRoute();
    let shortUrl = route.params.shortUrl;
    console.log(shortUrl);
    const apiUrl = 'http://localhost:8000/api/urls';

fetch(`${apiUrl}/${shortUrl}`)
  .then(response => {
    if (response.ok) {
      return response.json();
    } else {
      throw new Error('Failed to fetch original URL');
    }
  })
  .then(data => {
    const  long_url  = data.long_url;
    window.location.href = long_url; // Redirect to the original URL
  })
  .catch(error => {
    console.error(error);
  });
</script>

<template>
    <h2  class="mt-4 text-lg font-medium sm:text-xl mx-16">redirecting ....</h2>
</template>
