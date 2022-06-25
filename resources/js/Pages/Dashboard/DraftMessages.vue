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
import DraftList from '../../Module/DraftList.vue'
import EmptyListAlert from '../../Component/EmptyListAlert.vue'
import SearchBar from '../../Component/SearchBar.vue'

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
                  <SearchBar
                    v-model:searchField="searchKeyword"
                    @search-update="(keyword)=>{Inertia.visit(route('DraftMessages',{search_keyword: keyword}))}"
                  ></SearchBar>
                  <EmptyListAlert :show="draftMessageList.length==0">
                    No Draft Messages
                  </EmptyListAlert>
                  
                  
                    <!--<DraftTable v-model:tableData="draftMessageList" :extraFields="['', '']">
                          <template #tableExtraField="tableExtraField" >
                            <td>
                              <Button @click="eraseDraft(tableExtraField.eventId)" :rounded="false" class="mr-4">
                                Trash
                              </Button>
                            </td>
                            <td>
                              <Button @click="msgIdToView=tableExtraField.eventId;showNewMessageModal=true;" :rounded="false" class="mr-4">
                                Continue
                              </Button>
                            </td>
                          </template>
                    </DraftTable>-->
                    <DraftList 
                      v-model:tableData="draftMessageList"
                      @background-click="(msg_id)=>{msgIdToView=msg_id;showNewMessageModal=true;}"
                      @delete-click="(event_id)=>{eraseDraft(event_id)}"
                      :superHeader="true"
                    >
                      <template #superHeader>
                        <va-icon name="drafts" /> 
                      </template>
                    </DraftList>
                  

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
    draftMessageList: Array,
    message: Object,
    searchKeyword: String,
  },
  data() {
    return {
      sideBar:{
        minimized: true,
        
      },

      showNewMessageModal: false,
      msgIdToView: null,
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