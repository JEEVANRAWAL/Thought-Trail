<template>
   <q-page-container>
        <q-page padding>
          <div>
            <div v-html="pinia_state.fullBlog"></div>
          </div>
        </q-page>
    </q-page-container>
</template>

<script setup>
import {blogsStorage} from 'src/stores/BlogStorage'

const pinia_state= blogsStorage();
</script>

<style>

</style>