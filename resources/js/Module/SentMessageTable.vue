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
<style scope>
.list-enter-active,
.list-leave-active {
  transition: opacity 10s ease;

}
.list-enter-from,
.list-leave-to {
  opacity: 0;
}
</style>
<template>
  <div style=" overflow: auto;">
    <table class="va-table va-table--clickable" >
      <thead>
        <tr>
          <th scope="col">Sender</th>
          <th scope="col">Receiver</th>
          <th scope="col">Title</th>
          <th scope="col">Sent At</th>
          <th v-for="(field, index) in extraFields" :key="index" scope="col">{{field}}</th>
        </tr>
      </thead>
      <tbody>
        <TransitionGroup name="list">
          <tr v-for="(item, index) in tableData" :key="index" >
              <td>{{item.sender_public_code}}</td>
              <td>
                <MailCodeContactConvertField :publicCode="item.receiver_public_code" ></MailCodeContactConvertField>
                {{item.receiver_public_code}}-{{item.receiver_private_code}}</td>
              <td>{{item.message.title}}</td>
              <td>{{item.created_at}}</td>
              <slot name="tableExtraField" :messageId="item.id" ></slot>
          </tr>
        </TransitionGroup>
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



