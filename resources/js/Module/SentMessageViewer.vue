<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/
import Button from '../Element/Button.vue'

defineProps({
    msgId:{ 
        type: String,
        default: null
    },
  
});
defineEmits([
  'afterDeleteMessage'
])
</script>

<template>

    <div v-if="!privilege">
        No Privilege
    </div>
   <div v-if="privilege">
        <table class="va-table">
          <thead>
          <tr>
            <th></th>
            <th></th>
 
          </tr>
          </thead>
          <tbody>
            <tr>
              <td>Sender Public Code:</td>
              <td>{{mailData.sender_public_code}}</td>
            </tr>
            <tr>
              <td>Receiver List:</td>
              <td>
                <ul v-for="(receiver,index) in mailData.receiver_list" :key="index">
                  <li>{{receiver}}</li>
                </ul>
              </td>
            </tr>
            <tr>
              <td>Sent:</td>
              <td>{{mailData.created_at}}</td>
            </tr>
            <tr>
              <td>Title:</td>
              <td>{{mailData.message.title}}</td>
            </tr>
          </tbody>
        </table>
        <va-input
          style="border: 2px solid darkgray;"
          class="mb-3 "
          input-class="black p-2"
          :model-value="mailData.message.body"
          type="textarea"
          readonly
          autosize
        />

        <div v-if="mailData.deleted_at==null">
          <Button color="danger" gradient class="mr-4" @click="trash()">Trash</Button>
        </div>
        <div v-else>
          <Button color="success" gradient class="mr-4" @click="restore()">Restore</Button>
          <Button color="danger" gradient class="mr-4" @click="PermanentlyDelete()">Permanently Delete</Button>
        </div>
        
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
      dataUpdateCount: 0,
      mailData: null,
      privilege: null
    }
  },
  mounted() {
    this.fetchMailData()
    
  },
  watch: {
    dataUpdateCount: function (val) {
      //this.fullName = val + ' ' + this.lastName
      //console.log(this.dataUpdateCount)
      this.fetchMailData()
      
    }
  },
  methods: {
    async fetchMailData(){
        
        axios.post(route('viewASentMessage', {msg_id: this.msgId}))
          .then(
            response => {
                
                const d=response.data.data

                if (d.length==0) {
                    this.privilege=false
                    
                } else {
                    this.privilege=true
                    this.mailData=d[0]
                }
                
            })
            .catch(error=>{
                console.log(error)
            }); 
    },
    trash(){
     
      Inertia.post(route('trashSentMessage', {msg_id: this.msgId}), {
        onSuccess: () => {
          
          /*return Promise.all([
            this.doThing(),
            this.doAnotherThing()
          ])*/
        },
        onFinish: visit => {
          // This won't be called until doThing()
          // and doAnotherThing() have finished.
        },
      }) 
      this.dataUpdateCount=this.dataUpdateCount+1
      
      
    },
    restore(){
      
      Inertia.post(route('restoreSentMessage', {msg_id: this.msgId}), {
        onSuccess: () => {
          
        },
        onFinish: visit => {
          // This won't be called until doThing()
          // and doAnotherThing() have finished.
        },
      })
      this.dataUpdateCount=this.dataUpdateCount+1
    },
    PermanentlyDelete(){
      Inertia.post(route('permanentlyDeleteSentMessage', {msg_id: this.msgId}), {
        onSuccess: () => {
          
        },
        onFinish: visit => {
          // This won't be called until doThing()
          // and doAnotherThing() have finished.
        },
      });
      this.$emit('afterDeleteMessage')

    }
    /*selectContact(publicCode, privateCode){
        this.$emit('update:publicCode', publicCode);
        this.$emit('update:privateCode', privateCode);
    },*/
   
    
  }
}
</script>

