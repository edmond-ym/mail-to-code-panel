<script setup>
import { NButton } from 'naive-ui'
     
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    color: {
        type: String,
        default: null,
    },
    rounded:{
        type: Boolean,
        default: false
    }
    /*class:{
        type: String,
        default: null
    }*/
});
</script>

<template>
   
    <va-button :type="type" :color="color"   :rounded="rounded" >
        <slot />            
    </va-button>
</template>
