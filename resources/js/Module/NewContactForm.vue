<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/
import ContactField from '../../js/Component/ContactField.vue'
import randomstring from 'randomstring'
import Button from '../Element/Button.vue'
import Error from '../Component/Error.vue'

defineProps({
  errorsBagName:{
    type: String
  },
  errors:{
    type: Object
  }
})
defineEmits([
  'closeWindow'
]);
</script>

<template>
  <form  @submit.prevent="submit">
    <ContactField 
        v-model:firstName="newContact.firstName" 
        v-model:lastName="newContact.lastName" 
        v-model:contactList="newContact.contactList"
    ></ContactField>


    <Button type="submit"  @click="submit(newContact)">Add</Button>
  </form>
  <Error :data="errors"></Error>
</template>
<script>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import Nanobar from 'nanobar'

export default{
  mounted(){
    this.randomCaseId=randomstring.generate(6);
  },
  data() {
    return {
      randomCaseId: null,
      newContact:{
        firstName: null,
        lastName: null,
        contactList:[]
      }
  
    }
  },
  methods: {
    
    submit(){
      
      var transformedContactList=[]
      for (let index = 0; index < this.newContact.contactList.length; index++) {
        const contact = this.newContact.contactList[index];
        transformedContactList.push(contact.publicCode+'-'+contact.privateCode)
      }
      var nanobar = new Nanobar({
        classname: 'progress-bar',
        id: 'submission-progesss-bar',
      })
      nanobar.go(30);
      const form = useForm({
        firstName: this.newContact.firstName,
        lastName: this.newContact.lastName,
        contactList: transformedContactList
      })
      form.post(route('NewContact', {case_code: this.randomCaseId}), {
        errorBag: this.errorsBagName,
        preserveScroll: true,
        onSuccess: () => {
          this.$emit('closeWindow')
        },
      })
      nanobar.go(100)
    }
    
  }
}
</script>


