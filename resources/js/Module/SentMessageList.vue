<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/
import ContactField from '../../js/Component/ContactField.vue'
import MailCodeContactConvertField from './MailCodeContactConvertField.vue'
import MailListItem from '../Component/MailListItem.vue'
defineProps({
    tableData:{ 
        type: Array,
    },
    superHeader:{
      type: Boolean,
      default: false
    }
  
});
</script>
<style scope>

</style>
<template>

  <div style=" overflow: auto;">
    <div  v-for="(item, index) in tableData" :key="index">
      <MailListItem 
        @background-click="$emit('viewMessage', item.id)"
        :contact="item.receiver_list"
        :datetime="item.created_at"
        :title="item.message.title"
        :paragraph="item.message.body"
        :superHeader="superHeader"
      >
        <template #superHeader>
          <slot name="superHeader"></slot>
        </template>

      </MailListItem>
    </div>
    
  </div>
</template>
<script>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import Nanobar from 'nanobar'

export default{
   data() {
    return {
      
  
    }
  },
  methods: {
    
  }
}
</script>


