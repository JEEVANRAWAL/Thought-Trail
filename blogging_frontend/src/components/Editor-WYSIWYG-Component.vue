<template>
  
      <q-editor id="blogEditor"
        ref="editor"
        flat
        content-class="white"
        toolbar-text-color="black"
        toolbar-toggle-color="yellow-8"
        toolbar-bg="white"
        toolbar-push
        placeholder="Write your Story"
        :toolbar="[
          [{
            label: $q.lang.editor.align,
            icon: $q.iconSet.editor.align,
            fixedLabel: true,
            options: ['left', 'center', 'right', 'justify']
          }],
        
          ['bold', 'italic', 'underline', 'link', 'hr'],
          [{
            label: $q.lang.editor.formatting,
            icon: $q.iconSet.editor.formatting,
            list: 'no-icons',
            options: ['h1', 'h3', 'h4', 'h5', 'h6', 'p', 'code']
          },
          {
            label: $q.lang.editor.defaultFont,
            icon: $q.iconSet.editor.font,
            fixedIcon: true,
            list: 'no-icons',
            options: [
              'default_font',
              'arial',
              'arial_black',
              'comic_sans',
              'courier_new',
              'impact',
              'lucida_grande',
              'times_new_roman',
              'verdana'
            ]
          },
          {
            label: $q.lang.editor.fontSize,
            icon: $q.iconSet.editor.fontSize,
            fixedLabel: true,
            fixedIcon: true,
            list: 'no-icons',
            options: [
              'size-1',
              'size-2',
              'size-3',
              'size-4',
              'size-5',
              'size-6',
              'size-7'
            ]
          }
        ],
        ['imgResizer'],
        ['quote', 'unordered', 'ordered', 'outdent', 'indent'],
        ['insertimg']
        ]"
        :fonts="{
        arial: 'Arial',
        arial_black: 'Arial Black',
        comic_sans: 'Comic Sans MS',
        courier_new: 'Courier New',
        impact: 'Impact',
        lucida_grande: 'Lucida Grande',
        times_new_roman: 'Times New Roman',
        verdana: 'Verdana'
      }"
      >

      <template v-slot:insertimg>
          <q-fab
            icon="keyboard_arrow_right"
            direction="right"
            color="dark"
            :icon-size="3"
          >
           
              <q-file v-model="image" @update:model-value="myCustomImageThingieHandler" borderless>
                <template v-slot:default>
                  <q-fab-action color="dark" icon="image"></q-fab-action>
                </template>
              </q-file>
  
            <q-fab-action color="dark" icon="image_search" @click="unsplash = true"></q-fab-action>
          </q-fab>
      </template>

      <template v-slot:imgResizer>
        <q-btn-dropdown color="dark" label="Resize Image">
          <q-list>
              <q-item clickable v-close-popup @click="onItemClick">
                <q-item-section @click="handleimgSize('small')">
                 <q-item-label>small size</q-item-label>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup @click="onItemClick">
                <q-item-section @click="handleimgSize('medium')">
                 <q-item-label>medium size</q-item-label>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup @click="onItemClick">
                <q-item-section @click="handleimgSize('large')">
                 <q-item-label>large size</q-item-label>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup @click="onItemClick">
                <q-item-section @click="handleimgSize('extraLarge')">
                 <q-item-label>Extra large</q-item-label>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup @click="onItemClick">
                <q-item-section @click="handleimgSize('coverSize')">
                 <q-item-label>cover Size</q-item-label>
                </q-item-section>
              </q-item>

              <q-item clickable v-close-popup @click="onItemClick">
                <q-item-section @click="handleimgSize('largeCover')">
                 <q-item-label>large Cover</q-item-label>
                </q-item-section>
              </q-item>

          </q-list>
        </q-btn-dropdown>
      </template>


      </q-editor>
</template>

<script setup>
import { ref, defineEmits } from "vue";
import axios from 'axios';

const editor=ref();
const image=ref();
const imageUrl = ref('');
const imgWidth=ref('');
const imgHeight= ref('');

const emit= defineEmits(['ImageUrl'])

async function myCustomImageThingieHandler () {
    if (image.value) {
      const formData = new FormData();
      formData.append('Image', image.value);
      let UrlResponse='';

      try{

      const config= {headers:{'Content-Type': 'multipart/form-data'}};
      UrlResponse= await  axios.post('http://127.0.0.1:8000/api/saveImage', formData, config);
      console.log("choosen image stored!!");
      }catch(error){
        console.log(error);
      }
      
        const edit = editor.value;
        edit.caret.restore();
        // Use imageUrl directly to insert the data URL into the image source
        edit.runCmd('insertHTML', `<img src="${UrlResponse.data.image}" style=" width:${imgWidth.value}; height:${imgHeight.value}; object-fit:cover"/>`);
        edit.focus(); 
        image.value=null;

        emit('ImageUrl', UrlResponse.data.image)
    }
}

function handleimgSize(size){
  switch(size){
    case 'small':
      imgWidth.value= '250px';
      break;
    case 'medium':
      imgWidth.value= '350px';
      break;
    case 'large':
      imgWidth.value= '550px';
      break;
    case 'extraLarge':
      imgWidth.value= '650px';
      break;
    case 'coverSize':
      imgWidth.value= '850px';
      imgHeight.value= '300px';
      break;
    case 'largeCover':
      imgWidth.value= '1000px';
      imgHeight.value= '400px';
      break;
  }
}


</script>