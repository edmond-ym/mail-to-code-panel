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
import SentMessageList from '../../Module/SentMessageList.vue'
import EmptyListAlert from '../../Component/EmptyListAlert.vue'
import SearchBar from '../../Component/SearchBar.vue'

</script>

<template>
    
    
    <!-- Modal -->
    
    <MailAppLayout></MailAppLayout>
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
                  <SearchBar
                    v-model:searchField="searchKeyword"
                    @search-update="(keyword)=>{Inertia.visit(route('TrashedMessages',{search_keyword: keyword}))}"
                  ></SearchBar>
                  
                  
                 
                    <!--<ReceivedMessageTable v-model:tableData="trashedReceivedMessageList" :extraFields="['']">
                          <template #tableExtraField="tableExtraField" >
                            <td>
                              <Button @click="msgIdToView=tableExtraField.messageId;showReceivedMessageModal = !showReceivedMessageModal; " :rounded="false" class="mr-4">
                                View
                              </Button>
                            </td>
                          </template>
                    </ReceivedMessageTable>-->
                    <EmptyListAlert :show="trashedReceivedMessageList.length==0 && trashedSentMessageList.length==0">
                      No Trashed Messages
                    </EmptyListAlert>
                    <ReceivedMessageList
                      v-model:tableData="trashedReceivedMessageList"
                      @view-message="(msgId)=>{msgIdToView=msgId;showReceivedMessageModal = !showReceivedMessageModal; }"
                      superHeader="true"
                    >
                      <template #superHeader>
                        <va-icon name="inbox" />
                      </template>
                    </ReceivedMessageList>
                    <!--<SentMessageTable v-model:tableData="trashedSentMessageList" :extraFields="['']" >
                          <template #tableExtraField="tableExtraField" >
                            <td> 
                              <Button @click="msgIdToView=tableExtraField.messageId;showSentMessageModal = !showSentViewMessageModal; " :rounded="false" class="mr-4">
                                View
                              </Button>
                            </td>
                          </template>
                    </SentMessageTable>-->
                    <SentMessageList
                      v-model:tableData="trashedSentMessageList"
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
    searchKeyword: String,

    trashedMessageList: Array,
    trashedReceivedMessageList: Array,
    trashedSentMessageList: Array,

    message: Object,
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
    
    
  },
}
</script>