<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/

import { mdiCloudCheckOutline } from '@mdi/js';
defineProps({
    status:{ 
      type: String,
      default: null
    },
    
});

//library.add( faUserSecret)

</script>

<template>

    
    
    <div v-if="status=='saving'">
       <va-icon
         name="backup"
         class="mr-2"
       />
    </div>
    <div v-else>
      <va-icon
        name="cloud"
        class="mr-2"
      />
    </div>
</template>




<script>


export default {
    components:{
        
    }

}
</script>