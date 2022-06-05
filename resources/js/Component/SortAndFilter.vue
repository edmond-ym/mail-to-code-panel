<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/

import { mdiCloudCheckOutline } from '@mdi/js';
defineProps({
    data:{
        type: String
    },
    sortBy:{
        type: String,
        default: null
    },
    
});

//library.add( faUserSecret)

</script>

<template>
<slot name="after" :newData="data"></slot>
</template>




<script>


export default {
    components:{
        
    }
}
</script>