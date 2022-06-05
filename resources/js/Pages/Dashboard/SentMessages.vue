<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import 'bootstrap' 
import { Link } from '@inertiajs/inertia-vue3'
import NewMessageForm from '../../Module/NewMessageForm.vue'
import ReceivedMailViewer from '../../Module/ReceivedMessageViewer.vue' 
import SentMessageViewer from '../../Module/SentMessageViewer.vue'
import ReceivedMessageTable from '../../Module/ReceivedMessageTable.vue'
import SentMessageTable from '../../Module/SentMessageTable.vue'
import DraftTable from '../../Module/DraftTable.vue'
import MailAppLayout from '@/Layouts/MailAppLayout.vue'

import Button from '../../Element/Button.vue'
import Modal from '../../Element/Modal.vue'
import MailSideBar from '../../Module/MailSideBar.vue'

import FullScreenModal from '../../Element/FullScreenModal.vue'
import SentMessageList from '../../Module/SentMessageList.vue'
import EmptyListAlert from '../../Component/EmptyListAlert.vue'

</script>

<template>
    
    
    <!-- Modal -->
    
    <MailAppLayout :publicCode="publicCode"></MailAppLayout>
    <!-- Button trigger modal -->
    <!--<FullScreenModal 
      :show="true"
      title="fffff"
    ></FullScreenModal>-->
    <!--<AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Messages
            </h2>
        </template>-->
      <MailSideBar  :errors="errors" :publicCode="publicCode" >

        <template #content >
         
          <div class="py-12">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                      
                  </div>
                  
                 
                  
                    <!--<SentMessageTable v-model:tableData="sentMessages" :extraFields="['']" >
                          <template #tableExtraField="tableExtraField" >
                            <td>
                              <Button @click="msgIdToView=tableExtraField.messageId;showSentMessageModal = !showSentViewMessageModal; " :rounded="false" class="mr-4">
                                View
                              </Button>
                            </td>
                          </template>
                    </SentMessageTable>-->
                    <EmptyListAlert :show="sentMessages.length==0">
                      No Sent Messages
                    </EmptyListAlert>
                    <SentMessageList
                      v-model:tableData="sentMessages"
                      @view-message="(msgId)=>{msgIdToView=msgId;showSentMessageModal = !showSentViewMessageModal;}" 
                      superHeader="true"
                    >
                      <template #superHeader>
                        <va-icon name="send" />
                      </template>
                    </SentMessageList>
                 

                    <FullScreenModal :show="showSentMessageModal" @close-button="showSentMessageModal=false">
                      <SentMessageViewer @after-delete-message="showSentMessageModal=false;$vaToast.init({message: 'Message Deleted', position: 'top-right'});" :msgId="msgIdToView"></SentMessageViewer>
                    </FullScreenModal>
                    <FullScreenModal :show="showNewMessageModal" @close-button="showNewMessageModal=false">
                      <NewMessageForm 
                        :publicCode="publicCode" 
                        :initialEventCode="msgIdToView"
                        @after-submission="showNewMessageModal=false;$vaToast.init({message: 'Message Sent', position: 'top-right'})"
                        errorsBagName="newMessageForm"
                        :errors="errors.newMessageForm"
                      >
                      </NewMessageForm>
                    </FullScreenModal>
              </div>
             
          </div>
        </template>
      </MailSideBar>
    <!--</AppLayout>-->
    
</template>

<script>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import Nanobar from 'nanobar'




export default {
  props: {
    errors: Object,
    publicCode: String,
    sentMessages: Array,
    message: Object,
  },
  data() {
    return {
      sideBar:{
        minimized: true,
        
      },

      showNewMessageModal: false,
      msgIdToView: null,
      showSentMessageModal:false,
    }
  },
  methods: {

    
  },
}
</script>