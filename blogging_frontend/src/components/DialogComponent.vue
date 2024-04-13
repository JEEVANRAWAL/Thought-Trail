<template>
    <q-dialog :backdrop-filter="backdropFilter">
      <q-card class="dialog-box">
        <q-card-section class="row items-center q-pb-none text-h6">
          Login Form
          <q-btn style="margin-left: 16vw;" flat label="Close" color="primary" v-close-popup />
        </q-card-section>

        <q-card-section>
          <q-input class="dialog-box-input" outlined v-model="loginData.email" label="email" :dense="dense" />
        </q-card-section>
        <q-card-section>
          <q-input class="dialog-box-input" outlined v-model="loginData.password" label="password" type="password" :dense="dense" />
        </q-card-section>

        <q-card-section>
          <q-btn color="green"  label="Login" @click="login()"/>
        </q-card-section>

      </q-card>
    </q-dialog>
</template>

<script setup>
import { reactive, ref } from 'vue';
import axios from 'axios';
import { blogsStorage } from 'src/stores/BlogStorage';
import { useRouter } from 'vue-router';

const pinia_state= blogsStorage();
const router= useRouter();
const backdropFilter='blur(4px) saturate(150%)';
const dense=ref(false);
const emit= defineEmits(['changeDialogState'])

const loginData=reactive({
  email:'',
  password:''
})

async function login(){
  const jsonformatedData= JSON.stringify(loginData)
  const config= {headers:{'Content-Type': 'application/json'}, withCredentials: true}
  try{
    // console.log(jsonformatedData);
    const response= await axios.post('http://127.0.0.1:8000/api/login', jsonformatedData, config);
    if(response.status === 200){
      console.log(response.data);
      pinia_state.checkUserAuthentication();

      emit('changeDialogState');
    }
  }catch(error){
    console.log('error occurs while login. ', error.response.data.message)
  }
}

</script>

<style>

</style>