<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/
import ContactField from '../../js/Component/ContactField.vue'
import MailCodeContactConvertField from './MailCodeContactConvertField.vue'
defineProps({
    tableData:{ 
        type: Array,
    },
    extraFields:{
      type: Array,
      default: null
    }
});
</script>

<template>
  <div style=" overflow: auto;">
    <table class="va-table va-table--clickable" >
      <thead>
        <tr>
          <th scope="col">Sender</th>
          <th scope="col">Receiver</th>
          <th scope="col">Title</th>
          <th scope="col">Created</th>
          <th scope="col">Updated</th>
          <th v-for="(field, index) in extraFields" :key="index" scope="col">{{field}}</th>

        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in tableData" :key="index" >

            <td>{{item.sender_public_code}}</td>
            <td>
              {{item.receiver_list}}</td>
            <td>{{item.message.title}}</td>
            <td>{{item.created_at}}</td>
            <td>{{item.updated_at}}</td>

            
            <slot name="tableExtraField" :eventId="item.id" ></slot>
            
        </tr>
      </tbody>
    </table>
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


