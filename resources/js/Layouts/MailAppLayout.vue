<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue';
import JetBanner from '@/Jetstream/Banner.vue';
import JetDropdown from '@/Jetstream/Dropdown.vue';
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';
import JetNavLink from '@/Jetstream/NavLink.vue';
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';

defineProps({
    publicCode:{
        type: String
    }
});

const mainPageList=['MyMessages','SentMessages','DraftMessages','TrashedMessages','ContactList','PrivateCodeManager'];
const mainPage= () => {
  for (let index = 0; index < mainPageList.length; index++) {
    const mainPageName = mainPageList[index];
    if (route().current(mainPageName)) {
      return true;
    }
  }
  return false;
};

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>

  <div >
    <div class="app-bar-full">
      <div class="app-bar-left">
        <button class="app-bar-button"  :class="{'app-bar-button-selected':mainPage()}"  @click="Inertia.visit(route('MyMessages'), { method: 'get' })" ><va-icon name="home"></va-icon></button>
      </div>
      <div class="app-bar-right">
        <button class="app-bar-button"  :class="{'app-bar-button-selected':route().current('profile.show')}"  @click="Inertia.visit(route('profile.show'))"  ><va-icon name="person" ></va-icon></button>
        <button class="app-bar-button"  @click="Inertia.post(route('logout'))" ><va-icon name="logout"></va-icon></button>
      </div>
    </div>

  </div>
  
  <main style="margin-top: 0;">
      <slot />
  </main>
</template>
<style scope>
  .app-bar-full{
    /*display: inline;*/
    background-color: rgb(2, 105, 164);
    width: 100%;
    height: 40px;
    position: fixed;
  }
  .app-bar-left{
    float:left;
    border-color: black;
    background-color: transparent;
    height: 100%;
    margin-left: 5px;
  }
  .app-bar-right{
    float:right;
    border-color: black;
    background-color: transparent;
    height: 100%;
    margin-right: 5px;
  }
  .app-bar-button{
    width: 30px;
    height: 30px;
    margin-top: 5px;
    /*background-color: rgb(2, 105, 164);*/
    background-color: rgb(2, 105, 164);
    color: white;
    border-radius: 15px;
    
  }
  .app-bar-button-selected, .app-bar-button:hover{
    background-color: rgb(3, 138, 216)/*rgb(0, 180, 171)*/;
  }
</style>
<script>
import {VaSpacer, VaAppBar} from 'vuestic-ui'

export default{
    components:{
        VaSpacer,
        VaAppBar
    }
}
</script>



