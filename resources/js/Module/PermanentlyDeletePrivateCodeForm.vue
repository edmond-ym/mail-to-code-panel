<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/
import ContactField from '../../js/Component/ContactField.vue'
import Button from '../Element/Button.vue'
import Error from '../Component/Error.vue'

defineProps({
    errorsBagName:{
      type: String
    },
    errors:{
      type: Object
    },
    PrivateCode:{ 
      type: String,
    },
    PublicCode:{ 
      type: String,
    },

});
defineEmits([
  'deletedSuccessfully', 
  'closeWindow'
]);
</script>

<template>
  <form  @submit.prevent="submit">
    <div class="mb-3">
      <label for="nickname" class="form-label">Code</label>
      <input type="text" class="form-control" :value="PublicCode+'-'+PrivateCode" readonly >
    </div>
    <div class="mb-3">
      <label for="typePrivateCode" class="form-label">Type Private Code</label>
      <input type="text" class="form-control" id="typePrivateCode" v-model="PrivateCodePermenentlyDeleteForm.confirmPrivateCode" >
    </div>
    <div class="mb-3">
      <label for="confirmPassword" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="confirmPassword" v-model="PrivateCodePermenentlyDeleteForm.confirmPassword" >
    </div>
   

    <Button type="submit" @click="deletePrivateCode()"> Delete </Button>
    <Button @click="this.$emit('closeWindow')" outline>
        Close
    </Button>
    <Error :data="errors"></Error>


  </form>
  

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
      PrivateCodePermenentlyDeleteForm:{
        confirmPrivateCode: null,
        confirmPassword: null
      }
    }
  },
  mounted() {
    
  },
  methods: {
    deletePrivateCode(){
        //route('PermanentDelete'22222)
      var nanobar = new Nanobar({
        classname: 'progress-bar',
        id: 'submission-progesss-bar',
      })
      nanobar.go(30);
      const form = useForm(this.PrivateCodePermenentlyDeleteForm)
      form.post(route('PermanentlyDelete', {privateCode: this.PrivateCode}), {
        errorBag: this.errorsBagName,
        preserveScroll: true,
        onSuccess: () => {
          this.$emit('deletedSuccessfully')  
        },
      })
      nanobar.go(100)
    },
   
  }
}
</script>


