<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/

defineProps({
    data:{
        type: Object
    }
});



</script>

<template>
    
    <!--<div v-for="(msg, key) in data" :key="key" class="alert  d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
      <div>
        {{msg}}
      </div>
      <button type="button" class="btn-close float-right" style="float: right;" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>-->
    <div style="margin-top:20px;">
        <div v-for="(msg, key) in data" :key="key" style="background-color: rgb(224,60,60);color: white;border-radius: 0;"  class="alert alert-dismissible" role="alert">
           <div>{{msg}}</div>
           <button type="button" class="btn-close btn-close-white"  data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</template>




<script>


export default {
    data(){
        return{
        } 
    }
}
</script>