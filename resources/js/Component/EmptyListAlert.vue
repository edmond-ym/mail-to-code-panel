<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/

defineProps({
    show:{
        type: Boolean,
        default: false
    }
});



</script>

<template>
    <div v-if="show">
        <div
          class="big-box"
        >
        <slot />
        </div>
    </div>
    
</template>

<style scope>
.big-box{
    position: absolute;
    width: 100%;
    background-color: transparent; 
    left: 50%;
    top: 50%;

    
}
</style>


<script>


export default {
    data(){
        return{
        } 
    }
}
</script>