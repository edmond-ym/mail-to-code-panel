<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/

defineProps({
    firstName:{ 
      type: String,
      default: null
    },
    lastName: {
      type: String,      
      default: null
    },
    contactList:{
      type: Array,
      default: null
    }
});
defineEmits([
    'update:firstName',
    'update:lastName',
    'update:contactList',

]);
</script>

<template>
    
    <div class="mb-3">
      <label for="firstName" class="form-label">First Name</label>
      <input type="text" class="form-control" id="firstName" :value="firstName"
      @input="$emit('update:firstName', $event.target.value)" >
    </div>
    <div class="mb-3">
      <label for="lastName" class="form-label">Last Name</label>
      <input type="text" class="form-control" id="lastName" :value="lastName"
      @input="$emit('update:lastName', $event.target.value)" required>
    </div>
    <va-button type="submit" style="margin: 10px;"  class="mr-4" @click="addContact()">Add Contact</va-button>

    <div class="mb-3">
      <div v-for="(contact,index) in changedContactList" :key="index">
        
        <div class="input-group input-group-sm mb-3" id="receiver_code_input_group">
          <input type="text" class="form-control" placeholder="Public Code" aria-label="" v-model="contact.publicCode" @input="updateOutput();" required>
          <span class="input-group-text">-</span>
          <input type="text" class="form-control" placeholder="Private Code" aria-label="" v-model="contact.privateCode" @input="updateOutput();" required>
          <button class="btn btn-outline-secondary" type="button" @click="deleteContact(index);typeCount=typeCount+1;">-</button>
        </div>
      </div>
    </div>
    
</template>

<script>
export default{
  props:{
    
  },
  setup(){


    //this.changedContactList=this.contactList
  },
  mounted(){
    if (this.contactList==null) {
      this.changedContactList=[]
    } else {
      
      this.changedContactList=this.contactList
    }
  },
  methods:{
    addContact(){
      this.changedContactList.push({publicCode: null,privateCode: null});
      this.updateOutput();
    },
    deleteContact(index){
      this.changedContactList.splice(index,1);
      this.updateOutput();
    },
    updateOutput(){
      this.$emit('update:contactList', this.changedContactList)
    }
  },
  data(){
    return{
      changedContactList: null
    }
  }
}
</script>
