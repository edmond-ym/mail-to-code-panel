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
    //title: String,
});



const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>

<div >
   
    <div class="app-bar-full">
      <div class="app-bar-left">
        <va-button class="app-bar-button" icon="menu"   color="#fff" flat :rounded="false" />
        <va-button class="app-bar-button" icon="home"   color="#fff" @click="Inertia.visit(route('MyMessages'), { method: 'get' })" flat :rounded="false" />
      </div>
      <div class="app-bar-right">
        <va-button class="app-bar-button" icon="person" color="#fff" @click="Inertia.visit(route('profile.show'))" flat :rounded="false" />
        <va-button class="app-bar-button" icon="logout" color="#fff" @click="Inertia.post(route('logout'))" flat :rounded="false"/>
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

  }
  .app-bar-right{
    float:right;
    border-color: black;
    background-color: transparent;

  }
  .app-bar-button{
    width: 30px;
    height: 30px;
    margin-top: 2.5px;
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



