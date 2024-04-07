+<template>
  <q-layout view="hHh lpR fff">

    
      <q-header elevated class="text-font" :class="{'headerDarkMode-Bgcolor':$q.dark.isActive, 'darkModeText-color':$q.dark.isActive ,'bg-lightGray': $q.dark.isActive === false, 'text-dark': $q.dark.isActive === false}" height-hint="300">
        <q-toolbar>
          <q-btn class="xs" dense flat round icon="menu" @click="toggleLeftDrawer" />

            <q-toolbar-title class="flex items-center">
              <!-- avatar for extra small screen -->
              <q-avatar class="xs">
                <img src="public/icons/blog-logo3.png">
              </q-avatar>

              <!-- avatar for larger than extra small screen -->
              <q-avatar class="gt-xs icon-height_width">
                <img src="public/icons/blog-logo3.png">
              </q-avatar>

              <!-- for small screen -->
              <span class="xs my-font q-ml-md" style="font-size: 15px;">Tech & Travels Blog</span>

              <!-- for larger than extra small screen -->
              <span class="gt-xs my-font q-ml-md q-mr-xl">Tech & Travels Blog</span>

              <q-tabs no-caps :align="'left'" class="gt-xs font-size my-font2 inline q-ml-xl" :class="{'darkModeText-color':$q.dark.isActive}">
                <q-route-tab to="/" label="Home"/>
                <q-route-tab to="/blogs" label="Blog" />
                <q-route-tab to="/singlePost" label="Single Post" disable/>
                <q-route-tab to="/contact" label="Contact" />
                <q-route-tab class="route-tab" to="/writeBlog" label=""> 
                  <span class="material-symbols-outlined">edit_square <span class="write-label my-font2">write</span></span> 
                  
                </q-route-tab>
              </q-tabs>

              <div class="gt-xs q-pa-sm q-mt-sm searchbarSection q-mx-auto" style="width: 500px;">
                <div class="q-gutter-xl">
                  <q-input
                    v-model="searchInputText"
                    debounce="500"
                    filled
                    placeholder="Search"
                  >
                    <template v-slot:append>
                      <q-icon v-if="searchInputText !== ''" name="close" @click="searchInputText = ''" class="cursor-pointer"/>
                      <q-icon name="search" />
                    </template>
                  </q-input>
                </div>
              </div>
            </q-toolbar-title>

            <!-- Full Screen mode -->
            <q-btn 
              @click="$q.fullscreen.toggle()"
              :icon="$q.fullscreen.isActive ? 'fullscreen_exit' : 'fullscreen'"
              flat
              class="gt-xs q-mr-sm"
            >
            <q-tooltip ref="toolTip" class="bg-primary text-dark">{{$q.fullscreen.isActive ? 'Exit Fullscreen' : 'Go Fullscreen'}}</q-tooltip>
            </q-btn>

            <!-- dark mode toggler for desktop -->
            <q-toggle class="gt-xs q-mr-lg" @click="$q.dark.toggle" v-model="dark"> 
              <q-tooltip ref="toolTip" class="bg-primary text-dark">{{$q.dark.isActive ? 'Go lightMode' : 'Go DarkMode'}}</q-tooltip>
              <span v-if="$q.dark.isActive" class="material-symbols-outlined">light_mode</span>
              <span v-else class="material-symbols-outlined">clear_night</span>
            </q-toggle>

            <q-btn class="xs"  @click="$q.dark.toggle" flat dense>
              <span v-if="$q.dark.isActive" class="material-symbols-outlined">light_mode</span>
              <span v-else class="material-symbols-outlined">clear_night</span>
            </q-btn>


          <!-- profile icon for extra small screen only -->
          <q-btn dense flat round icon="person" @click="toggleRightDrawer" size="20px" class="xs"/>
          <!-- icon for greater than extra small screen -->
          <q-btn dense flat round icon="person" @click="toggleRightDrawer" @mouseover="startFadeTimeout" size="25px" class="gt-xs">
            <q-tooltip ref="toolTip" class="bg-primary text-dark">Profile</q-tooltip>
          </q-btn>
        </q-toolbar>


      </q-header>

    <q-drawer v-model="leftDrawerOpen" side="left" class="font-size my-font3 q-pt-md" :width='220' overlay bordered>
      <!-- search bar -->
      <div class="q-ma-sm">
        <q-input bottom-slots v-model="searchInputText" label="Search">

          <template v-slot:append>
          <q-icon v-if="searchInputText !== ''" name="close" @click="searchInputText = ''" class="cursor-pointer"/>
          <q-icon name="search" />
          </template>

        </q-input>
      </div>
      <!-- menu area -->
      <q-scroll-area class="fit">
        <q-list>
          <q-item to="/" clickable v-ripple>
            <q-item-section avatar >
              <q-icon name='home' />
            </q-item-section>
            <q-item-section>Home</q-item-section>
          </q-item>

          <q-item to="/blogs" clickable v-ripple>
            <q-item-section avatar>
                  <q-icon name='book' />
            </q-item-section>
            <q-item-section>Blog</q-item-section>
          </q-item>
          
          <q-item to="/singlePost" clickable v-ripple disable>
            <q-item-section avatar>
              <!-- post icon from google font -->
              <span class="material-symbols-outlined">post</span>
            </q-item-section>
            <q-item-section>Single Post</q-item-section>
          </q-item>

          <q-item to="/contact" clickable v-ripple>
            <q-item-section avatar>
              <!-- icon from google font -->
              <span class="material-symbols-outlined">contact_support</span>
            </q-item-section>
            <q-item-section>Contact</q-item-section>
          </q-item>
          
          <q-item to="/writeBlog" clickable v-ripple>
            <q-item-section avatar>
              <!-- icon from google font -->
              <span class="material-symbols-outlined">edit_square <span class="write-label my-font2">write</span></span> 
            </q-item-section>
          </q-item>
        </q-list>
      </q-scroll-area>
    </q-drawer>

    <q-drawer v-model="rightDrawerOpen" side="right" :width="sideNavbarwidth" overlay bordered>
      <!-- drawer content -->
    </q-drawer>

    <!-- :class="{'bgColor-body': $q.dark.isActive === false}" -->
    <q-page-container>
      <router-view />
    </q-page-container>

    <q-footer bordered class="bg-grey-8 text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="public/icons/blog-logo3.png">
          </q-avatar>
          <div>Title</div>
        </q-toolbar-title>
      </q-toolbar>
    </q-footer>

  </q-layout>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue'
import { Platform, useQuasar } from 'quasar'

  const $q = useQuasar()
  const searchInputText= ref('');
  const dark= ref(false);
  const leftDrawerOpen = ref(false)
  const rightDrawerOpen = ref(false)
  const fadeTimeout= ref(null);
  const toolTip=ref();

  // side navbar toggle section
  function toggleLeftDrawer () {
    leftDrawerOpen.value = !leftDrawerOpen.value
  }


  function toggleRightDrawer () {
    rightDrawerOpen.value = !rightDrawerOpen.value
  }
  
  // side navbar width based on platform
  const sideNavbarwidth= computed(()=>{
    return $q.platform.is.mobile ? 220 : 300
  });

  // This function hides tool tips popup after 1500 millisecond on mouseover
  function startFadeTimeout(){
    setTimeout(()=>{
      hideTooltip()
    },1500);
  }
  
  function hideTooltip(){
    toolTip.value.hide();
  }

</script>

<style scoped>

.write-label{
  font-size: 18px;
  margin-left: 10px;
}


</style>