<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/
import ContactField from '../../js/Component/ContactField.vue'
import Button from '../Element/Button.vue'

defineProps({
    publicCode:{ 
        type: String,
        default: null
    },
    privateCode:{
        type: String,
        default: null
    }
    
});
defineEmits([
    'update:publicCode',
    'update:privateCode',
    'selected'

]);
</script>

<template>
 
  <va-list>
    <va-list-label color="#ff0000">
      Contact List
    </va-list-label>
    <va-card  v-for="(contact, index) in contactData"  :key="index">
        <va-card-title>{{contact.firstName}}  {{contact.lastName}} </va-card-title>
        <va-card-content>
          <va-list-item
            v-for="(mailCode, index1) in contact.contactList" :key="index1"
          >
   
            
            <va-list-item-section>
              <va-list-item-label>
                {{mailCode}}
              </va-list-item-label>
      
            </va-list-item-section>
      
            <va-list-item-section >
              <Button @click="selectContact(mailCode)"> Select </Button>
            </va-list-item-section>
          </va-list-item>
          
        </va-card-content>
    </va-card>
    
  </va-list>

 
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
      contactData: null,
    }
  },
  mounted() {
    this.fetchContactList()
  },
  methods: {
    async fetchContactList(){
        axios.post(route('FetchContact'))
          .then(
            response => {
                this.contactData=response.data.data
                
            })
            .catch(error=>{
                console.log(error)
            });
    },
    selectContact(mailCode){
        const arr=mailCode.split("-");
        const publicCode=arr[0];
        const privateCode=arr[1]

        this.$emit('update:publicCode', publicCode);
        this.$emit('update:privateCode', privateCode);
        this.$emit('selected');
    },
   
    
  }
}
</script>


