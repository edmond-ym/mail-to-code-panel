<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import MailCodeAutoFill from '../Module/MailCodeAutoFill.vue'
import randomstring from 'randomstring'
import SaveStatus from '../Component/SaveStatus.vue'
//import { mdiCloudSyncOutline } from '@mdi/js';
import Button from '../Element/Button.vue'
import Modal from '../Element/Modal.vue'
import Error from '../Component/Error.vue'

defineProps({
    publicCode:{ 
      type: String,
    },
    errorsBagName:{
      type: String
    },
    errors:{
      type: Object
    },
    initialEventCode:{
      type: String,
      default: null
    },
});
defineEmits([
  'afterSubmission'
]);

</script>

<template>
    <div >
      <va-app-bar color="#ffffff">
        <SaveStatus :status="saveStatus"></SaveStatus>
        <va-spacer />

      </va-app-bar>
    </div>
    <form  @submit.prevent="submit">
        
        <Modal v-model="AutoFillModal.show"  title="Autofill"  message="
        Select the corresponding contact to autofill the mail code"   size="large">
          
          <MailCodeAutoFill 
            v-model:publicCode="newMessageForm.receiver_list[AutoFillModal.contactIndex].publicCode" 
            v-model:privateCode="newMessageForm.receiver_list[AutoFillModal.contactIndex].privateCode"
            @selected="typeCount=typeCount+1"
          ></MailCodeAutoFill>
        </Modal>

        <div class="row">
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="receiver_code_input_group">Receiver Code</label>
            <Button type="submit" style="margin: 10px;" class="btn btn-primary" @click="addContact()">Add</Button>
            <div v-for="(receiver,index) in newMessageForm.receiver_list" :key="index">
              
              <div class="input-group input-group-sm mb-3" id="receiver_code_input_group">
                
                <input type="text" class="form-control" placeholder="Public Code" aria-label="" v-model="receiver.publicCode" @input="typeCount=typeCount+1" required>
                <span class="input-group-text">-</span>
                <input type="text" class="form-control" placeholder="Private Code" aria-label="" v-model="receiver.privateCode" @input="typeCount=typeCount+1" required>
                <Button type="button" outline @click="AutoFillModal.show = !AutoFillModal.show; AutoFillModal.contactIndex=index">Fill</Button>
                <Button type="button" class="mr-4" @click="newMessageForm.receiver_list.splice(index,1);typeCount=typeCount+1;">-</Button>
              </div>

            </div>
            
          </div>
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">                         
            <label for="sender_code_input_group" class="form-label">Sender Code</label>
            <div class="input-group input-group-sm mb-3" id="sender_code_input_group">
              <input type="text" class="form-control" readonly  v-model="publicCode">
            </div>
          </div>
        </div>
       
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" id="title" class="form-control"   v-model="newMessageForm.message.title" @input="typeCount=typeCount+1" required>
        </div>
        <div class="mb-3">
          <label for="body" class="form-label">Body</label>
          <textarea class="form-control" id="body" rows="3" v-model="newMessageForm.message.body" @input="typeCount=typeCount+1" required></textarea>
        </div>
        <Button type="submit"  @click="sendMessage()">Submit</Button>
    </form>
    <Error :data="errors"></Error>

</template>
<script>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import Nanobar from 'nanobar'


export default {
  props: {
    
  },
  mounted(){
    if (this.initialEventCode==null) {
      this.event_id=randomstring.generate(10)
    }else{
      this.event_id=this.initialEventCode
      this.fetchDraftMessage()
    }
    
  },
 
  data() {
    return {
      /*icons: {
        mdiCloudSyncOutline
      },*/
      typeCount:0,
      event_id: null,
      saveStatus:null,
      AutoFillModal:{
        contactIndex: null,
        show: false,
      },
      newMessageForm:{
        receiver_list: [

        ],
        message: {
          title: null,
          body: null
        } 
      }
    }
  },
  watch:{
    typeCount: function (val) {

      this.updateOrSaveMessage()
    }
  },
  methods: {
    addContact(){
      this.newMessageForm.receiver_list.push({privateCode:null, publicCode: null})
    },
    sendMessage(){
      var transformedReceiverList=[]
      for (let index = 0; index < this.newMessageForm.receiver_list.length; index++) {
        const contact = this.newMessageForm.receiver_list[index];
        transformedReceiverList.push(contact.publicCode+'-'+contact.privateCode)
      }
  
      var nanobar = new Nanobar({
        classname: 'progress-bar',
        id: 'submission-progesss-bar',
      })
      nanobar.go(30);
      const form = useForm({
        receiver_list: transformedReceiverList,
        message: this.newMessageForm.message
      })
      form.post(route('SendMessage', {event_id: this.event_id}), {
        errorBag: this.errorsBagName,
        preserveScroll: true,
        onSuccess: () => {/*this.newCodeForm.nickname="";*/
          this.$emit('afterSubmission')
        },
      })
      nanobar.go(100)
    },
    updateOrSaveMessage(){
      this.saveStatus='saving'
      var transformedReceiverList=[]
      for (let index = 0; index < this.newMessageForm.receiver_list.length; index++) {
          const contact = this.newMessageForm.receiver_list[index];
          transformedReceiverList.push(contact.publicCode+'-'+contact.privateCode)
      }
      const form = useForm({
        receiver_list: transformedReceiverList,
        message: this.newMessageForm.message
      })
      form.post(route('updateDraftMessage', {event_id: this.event_id }), {
        preserveScroll: true,
        onSuccess: () => {
          this.saveStatus='saved'
          //this.$emit('afterSubmission')
        },
      })
    },
    fetchDraftMessage(){
      axios.post(route('viewDraftMessage', {event_id: this.event_id}))
          .then(
            response => {
                
                const d=response.data.data
                const con_list=d[0].receiver_list
                var new_receiver_list=[]
                for (let index = 0; index < con_list.length; index++) {
                  const element = con_list[index];
                  const arr=element.split("-");
                  new_receiver_list.push({privateCode:arr[1], publicCode: arr[0]})
                }
                this.newMessageForm.receiver_list=new_receiver_list
                this.newMessageForm.message=d[0].message
       
                
            })
            .catch(error=>{
                console.log(error)
            }); 
    }
     
    
  },
}
</script>