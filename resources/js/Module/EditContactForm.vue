<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/
import ContactField from '../../js/Component/ContactField.vue'
import Button from '../Element/Button.vue'
import Modal from '../Element/Modal.vue'
import Error from '../Component/Error.vue'


defineProps({
    caseCode:{ 
      type: String,
    },
    errorsBagName:{
      type: String
    },
    errors:{
      type: Object
    }
});
defineEmits([
  'deletedSuccessfully',
  'updatedSuccessfully'

]);
</script>

<template>

  <form  @submit.prevent="submit">
    
    <ContactField 
        v-model:firstName="Contact.firstName" 
        v-model:lastName="Contact.lastName" 
        v-model:contactList="Contact.contactList"
    ></ContactField>

    
    <Button type="submit" class="mr-2" @click="submit()">Amend</Button>
    <Button type="button" class="mr-2" @click="showDeleteContactModal = !showDeleteContactModal" :rounded="false"  color="danger">
      Delete
    </Button>
  </form>
  <Error :data="errors"></Error>
 

 

  
    
  <Modal
    v-model="showDeleteContactModal"
    title="Delete Contact"
    message="Are you sure to delete contact?"
    
    fixed-layout
    
    @ok="deleteContact()"
  />

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
      showDeleteContactModal: false,
      Contact:{
        firstName: null,
        lastName: null,
        contactList:[]
      },
  
    }
  },
  mounted() {
    // fetch on init
    this.initialFetch()
  },
  methods: {
    async initialFetch(){
        const a=axios.post(route('FetchContact', {case_code: this.caseCode}))
          .then(
            response => {
              this.Contact.firstName = response.data.data.firstName
              this.Contact.lastName=response.data.data.lastName
              
              const originalContactList=response.data.data.contactList
              for (let index = 0; index < originalContactList.length; index++) {
                  const element = originalContactList[index];
                  const arr=element.split("-");
                  this.Contact.contactList.push({privateCode:arr[1], publicCode: arr[0]})
              }
            });
          
    },
    submit(){
      var transformedContactList=[]
      for (let index = 0; index < this.Contact.contactList.length; index++) {
        const contact = this.Contact.contactList[index];
        transformedContactList.push(contact.publicCode+'-'+contact.privateCode)
      }
      var nanobar = new Nanobar({
        classname: 'progress-bar',
        id: 'submission-progesss-bar',
      })
      nanobar.go(30);
      const form = useForm({
        firstName: this.Contact.firstName,
        lastName: this.Contact.lastName,
        contactList: transformedContactList
      })
      form.post(route('UpdateSpecificContact', {case_code: this.caseCode}), {
        preserveScroll: true,
        onSuccess: () => {
          this.initialFetch()
          this.$emit('updatedSuccessfully')  
        },
      })
      nanobar.go(100)
    },
    deleteContact(){

      var nanobar = new Nanobar({
        classname: 'progress-bar',
        id: 'submission-progesss-bar',
      })
      nanobar.go(30);
      const form = useForm({caseCode: this.caseCode})
      form.post(route('DeleteSpecificContact', {case_code: this.caseCode}), {
        errorBag: this.errorsBagName,
        preserveScroll: true,
        onSuccess: () => {
          //this.initialFetch()
          this.$emit('deletedSuccessfully')
        },
      })
      nanobar.go(100)
    }
    
  }
}
</script>


