<template>
   <q-page-container>
        <q-page padding>
          <div v-for="n in blogwarehouse.blog" :key="n">
            <div v-html="n.content"></div>
          </div>
        </q-page>
    </q-page-container>
</template>

<script setup>
import {blogsStorage} from 'src/stores/BlogStorage'

const blogwarehouse= blogsStorage();
</script>

<style>

</style>