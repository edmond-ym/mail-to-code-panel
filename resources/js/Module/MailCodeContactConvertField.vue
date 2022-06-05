

<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/

defineProps({
    publicCode: {
      type: String,
      default: null
    },

});

</script>

<template>
  
  
  <div v-for="(item, index) in contactData" :key="index" >

    <va-list-item-section v-if="item.publicCode==publicCode">
      <va-list-item-label>
       {{item.firstName}} {{item.lastName}}
      </va-list-item-label>
      <va-list-item-label caption hidden>
       
      </va-list-item-label>
    </va-list-item-section>
  </div>
  
</template>

<script>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import Nanobar from 'nanobar'
import axios from 'axios'

export default{
  
  data() {
    return {
      contactData:null
  
    }
  },
  mounted() {
    // fetch on init
    this.initialFetch()
  },
  methods: {
    async initialFetch(){
        axios.post(route('FetchContact'))
          .then(
            response => {
              this.contactData=response.data.data
            });
    },
    
    
  }
}
</script>


