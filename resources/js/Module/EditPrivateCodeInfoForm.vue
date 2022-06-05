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
    currentNickname:{
      type: String
    },
    PrivateCode:{ 
      type: String,
    },
    PublicCode:{ 
      type: String,
    },
});
defineEmits([
  'updatedSuccessfully', 
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
      <label for="nickname" class="form-label">Nickname</label>
      <input type="text" class="form-control" id="nickname" v-model="PrivateCodeEditForm.nickname" >
    </div>
    <Button type="submit" @click="update()"> Amend </Button>
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
import axios from 'axios'

export default{
  
  data() {
    return {
      showDeleteContactModal: false,
      PrivateCodeEditForm:{
        nickname: null
      }
    }
  },
  mounted() {
    // fetch on init
    this.PrivateCodeEditForm.nickname=this.currentNickname

  },
  methods: {
    update(){
      var nanobar = new Nanobar({
        classname: 'progress-bar',
        id: 'submission-progesss-bar',
      })
      nanobar.go(30);
      const form = useForm(this.PrivateCodeEditForm)
      form.post(route('AmendPrivateCodeInfo', {privateCode: this.PrivateCode}), {
        errorBag: this.errorsBagName,
        preserveScroll: true,
        onSuccess: () => {
          this.$emit('updatedSuccessfully')  
        },
      })
      nanobar.go(100)
    },
   
  }
}
</script>


