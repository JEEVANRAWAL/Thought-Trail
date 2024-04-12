<template>
   <div class="q-pa-md">
    <q-btn color="purple" @click="showNotif" label="Show Notification" />

    <q-btn color="purple" @click="dialog=true" label="Show dialog" />


    <q-dialog v-model="dialog" :backdrop-filter="backdropFilter">
      <q-card class="dialog-box">
        <q-card-section class="row items-center q-pb-none text-h6">
          Login Form
          <q-btn style="margin-left: 16vw;" flat label="Close" color="primary" v-close-popup />
        </q-card-section>

        <q-card-section>
          <q-input class="dialog-box-input" outlined v-model="text" label="email" :dense="dense" />
        </q-card-section>
        <q-card-section>
          <q-input class="dialog-box-input" outlined v-model="text" label="password" type="password" :dense="dense" />
        </q-card-section>

        <q-card-section>
          <q-btn color="green"  label="Login" />
        </q-card-section>

      </q-card>
    </q-dialog>
  </div>
</template>

<script setup>
import { useQuasar } from 'quasar'
import { ref } from 'vue';

    const $q = useQuasar()
    const dialog= ref(true);
    const backdropFilter='blur(4px) saturate(150%)';

    
    function  showNotif () {
        $q.notify({
          message: 'Jim pinged you.',
          color: 'purple',
          position: 'top'
        })
      }
</script>

<style scoped>
.dialog-box{
  display: block;
  width: 100vw;
}
</style>