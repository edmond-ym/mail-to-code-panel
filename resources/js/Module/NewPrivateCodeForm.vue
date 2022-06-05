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
  }
})
defineEmits([
  'added',
  'closeWindow'
]);
</script>

<template>

    <form  @submit.prevent="submit">
        
        <div class="mb-3">
          <label for="nickname" class="form-label">Nickname</label>
          <input type="text" class="form-control" id="nickname" v-model="newCodeForm.nickname" >
        </div>
        <Button type="submit" @click="newCodeFormSubmit()"> Add </Button>
        <Button @click="this.$emit('closeWindow')" outline>
            Close
        </Button>
  
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
   data() {
    return {
      newCodeForm: {
        nickname: null,
      }
    }
  },
  methods: {
    newCodeFormSubmit() {
      var nanobar = new Nanobar({
        classname: 'progress-bar',
        id: 'submission-progesss-bar',
      })
      nanobar.go(30);
      const form = useForm(this.newCodeForm)
      form.post(route('NewPrivateCode'), {
        errorBag: this.errorsBagName,
        preserveScroll: true,
        onSuccess: () => {
            this.newCodeForm.nickname="";
            
            this.$emit('added');
        },
      })
      nanobar.go(100);
      
    },
    
  }
}
</script>


