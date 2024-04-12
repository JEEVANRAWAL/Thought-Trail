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
          <q-btn color="green"  label="Login" @click="login(loginData)"/>
        </q-card-section>

      </q-card>
    </q-dialog>
</template>

<script setup>
import { reactive } from 'vue';
import axios from 'axios';


const loginData=reactive({
  email:'',
  password:''
})

async function login(data){
  const jsonformatedData= JSON.stringify(data)
  const config= {headers:{'Content-Type': 'application/json'}}
  try{
    // console.log(jsonformatedData);
    const response= await axios.post('http://127.0.0.1:8000/api/login', jsonformatedData, config);
    console.log(response.data);
  }catch(error){

  }
}

</script>

<style>

</style>