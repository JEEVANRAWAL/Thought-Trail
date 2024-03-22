<template>
  <q-btn style="background: goldenrod; color: white" :icon="icon" :label="label" />
</template>

<script setup> 
const prop= defineProps({
    label:{
        type: String,
        default: null
    },
    icon:{
        type: String,
        default: null
    },
    backgroundColor:{
        type: String,
        default: null
    }
    
})
</script>

<style>

</style>