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

import ReceivedMessageList from '../../Module/ReceivedMessageList.vue'
import EmptyListAlert from '../../Component/EmptyListAlert.vue'
import SearchBar from '../../Component/SearchBar.vue'
</script>

<template>
    
    <MailAppLayout ></MailAppLayout>
    

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

                  <SearchBar
                    v-model:searchField="searchKeyword"
                    @search-update="(keyword)=>{Inertia.visit(route('MyMessages',{search_keyword: keyword}))}"
                  ></SearchBar>
                  <!--<ReceivedMessageTable v-model:tableData="messageList" :extraFields="['']">
                    <template #tableExtraField="tableExtraField" >
                      <td>
                        <Button v-if="tableExtraField.readAt==null" color="success"  @click="msgIdToView=tableExtraField.messageId;showReceivedMessageModal = !showReceivedMessageModal; " :rounded="false" class="mr-4">
                          View
                        </Button>
                        <Button v-else  @click="msgIdToView=tableExtraField.messageId;showReceivedMessageModal = !showReceivedMessageModal; " :rounded="false" class="mr-4">
                          View
                        </Button>
                      </td>
                    </template>
                  </ReceivedMessageTable>-->
                  <EmptyListAlert :show="messageList.length==0">
                    No Messages
                  </EmptyListAlert>
                  <ReceivedMessageList
                    v-model:tableData="messageList"
                    @view-message="(msgId)=>{msgIdToView=msgId;showReceivedMessageModal = !showReceivedMessageModal; }"
                    superHeader="true"
                  >
                    <template #superHeader>
                        <va-icon name="inbox" />
                    </template>
                  </ReceivedMessageList>
                  <FullScreenModal :show="showReceivedMessageModal" @close-button="showReceivedMessageModal=false">
                    <ReceivedMailViewer @after-delete-message="showReceivedMessageModal=false;$vaToast.init({message: 'Message Deleted', position: 'top-right'});" :msgId="msgIdToView"></ReceivedMailViewer>
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
    messageList: Array,
    message: Object,
    searchKeyword: String,
  },
  data() {
    return {
      sideBar:{
        minimized: true,
        
      },
      showReceivedMessageModal: false,
      msgIdToView: null,
      showSentMessageModal:false,
    }
  },
  methods: {
    eraseDraft(event_id){
      
      var nanobar = new Nanobar({
        classname: 'progress-bar',
        id: 'submission-progesss-bar',
      })
      nanobar.go(30);
      const form = useForm({})
      form.post(route('eraseDraftMessage', {event_id: event_id}), {
        errorBag: 'eraseDraft',
        preserveScroll: true,
        onSuccess: () => {
          
        },
      })
      nanobar.go(100)

    }
    
  },
}
</script>