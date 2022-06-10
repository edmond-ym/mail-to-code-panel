<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import 'bootstrap' 
import { Link } from '@inertiajs/inertia-vue3'
import DialogModal from '../../Jetstream/DialogModal.vue'
import NewContactForm from '../../Module/NewContactForm.vue'
import EditContactForm from '../../Module/EditContactForm.vue'
import MailAppLayout from '@/Layouts/MailAppLayout.vue'

import Button from '../../Element/Button.vue'
import Modal from '../../Element/Modal.vue'
import FullScreenModal from '../../Element/FullScreenModal.vue'
import MailSideBar from '../../Module/MailSideBar.vue'
import ContactCard from '../../Component/ContactCard.vue'
import EmptyListAlert from '../../Component/EmptyListAlert.vue'
</script>

<template>
    <MailAppLayout></MailAppLayout>

    <!--<AppLayout title="Contact List">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contact List
            </h2>
        </template>-->
      <MailSideBar  :errors="errors" :publicCode="publicCode" >
        <template #content>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    
    
                    </div>
                    <Button @click="showNewContactModal = !showNewContactModal" :rounded="false" class="mr-4" style="position: static;">
                      New
                    </Button>
                     
                    
                    <FullScreenModal :show="showNewContactModal" @close-button="showNewContactModal=false">
                      <NewContactForm 
                        @close-window="showNewContactModal = false;$vaToast.init({message: 'Contact Added', position: 'top-right'});"
                        errorsBagName="newContactForm"
                        :errors="errors.newContactForm"
                      ></NewContactForm>
                    </FullScreenModal>
                    <!---->
                    <FullScreenModal :show="EditContactModal.show" @close-button="EditContactModal.show=false">
                      <EditContactForm 
                        :caseCode="EditContactModal.caseCode"
                        @deleted-successfully="EditContactModal.show=false;$vaToast.init({message: 'Contact Deleted', position: 'top-right'});"
                        @updated-successfully="EditContactModal.show=false;$vaToast.init({message: 'Contact Updated', position: 'top-right'});"  
                        errorsBagName="editContactForm"
                        :errors="errors.editContactForm"
                      ></EditContactForm>
                    </FullScreenModal>
    
                    <EmptyListAlert :show="contactList.length==0">
                      No Contacts
                    </EmptyListAlert>
                    <div style=" overflow: auto;">
                      <div v-for="(item, case_code) in contactList" :key="case_code">
                        
                        <ContactCard
                          :firstName="item.firstName"
                          :lastName="item.lastName"
                          :mailCodeList="item.contactList"
                          @background-click="EditContactModal.show = !EditContactModal.show;EditContactModal.caseCode= case_code "
                        ></ContactCard>
                      </div>
                      
                      <!--<table  class="va-table va-table--clickable">
                        <thead>
                          <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Mail code</th>
                            <th scope="col"></th>
      
                          </tr>
                        </thead>
                        <tbody >
                          <tr v-for="(item, case_code) in contactList" :key="case_code">
                            <td>{{item.firstName}}</td>
                            <td>{{item.lastName}}</td>
                            <td>
                              <ul v-for="(mailCode, index) in item.contactList" :key="index">
                                <li>{{mailCode}}</li>
                              </ul>
                            </td>
                            <td>                        
                              <Button @click="EditContactModal.show = !EditContactModal.show;EditContactModal.caseCode= case_code " :rounded="false" class="mr-4">
                                Edit
                              </Button>
                            </td>
                          </tr>
                        </tbody>
                      </table>-->
                    </div>
    
                    
                    
                   
                    
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
    publicCode: String,
    contactList: Object,
    errors: Object,
  },
  data() {
    return {
      showNewContactModal: false,
      EditContactModal:{
        show: false,
        caseCode: null
      }
  
    }
  },
  methods: {
    
    
  },
  components:{
    NewContactForm, AppLayout, Link
  }
}
</script>