<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/
import ContactField from '../../js/Component/ContactField.vue'
import MailCodeContactConvertField from './MailCodeContactConvertField.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import FullScreenModal from '../Element/FullScreenModal.vue'
import NewMessageForm from '../Module/NewMessageForm.vue'

defineProps({
    /*tableData:{ 
        type: Array,
    },
    extraFields:{
      type: Array,
      default: null
    }*/
    publicCode:{
        type: String
    },
    errors:{
        type: Object
    }
});
defineEmits([
    'newMessageModal'
])
</script>
<style scope>
    .view{
      --background-color:rgb(2, 105, 164);/*rgb(37, 80, 192)*/; 
      
    }
    .mailSideBar{
        padding: 0;
        width: 150px;
        position: fixed;
        height: 100%;
        /*overflow: scroll;*/
        background-color: var(--background-color);
        overflow: hidden ;
        /*margin-top: 6px;*/
        top: 40px;

        
    }       
    .mailSideBar-buttonPart{
       margin-top: 50px;
       

    }
    .mailSideBar-newMessageModalButton{
        background-color: rgb(248,248,255);
        display: block;
        padding-top: 10px;
        padding-bottom: 10px;
        border-radius: 25px;
        margin-bottom: 10px;
        text-decoration: none;
        color: black;
        padding-left: 10px;
        padding-right: 10px;
        width:130px;
        margin-left: 10px;
        
    }
    .mailSideBar-newMessageModalButton-text{
        font-size: 13px;
    }

    .mailSideBar-newMessageModalButton:hover{
        background-color: rgb(54, 69, 79);
        color: white;
    }
    .mailSideBar-button, .mailSideBar-space {
        background-color: var(--background-color);
        display: block;
        padding: 16px;
        text-decoration: none;
        color: white;
        width:  100%;
        text-align: left;
    }
    .mailSideBar-button-text{
        margin-left: 5px;

    }
    .mailSideBar-button.active{
        background-color: #f4f8fa;
        color:black;
    }

    .mailSideBar-button:hover{
        background-color: #f4f8fa;
        color:black;
    }
    .content{
        margin-left: 200px;
        /*position: static;
        
        width: 100%;*/
    }.view{
        position: static;
    }
    @media screen and (max-width: 700px) {
        .mailSideBar-button-text{
            display: none; 
        }
        .mailSideBar{
            width: 60px;
        }
        .content{
            margin-left: 65px; 
            
        }  
        .mailSideBar-newMessageModalButton{
            --bar-width: 60px;
            --button-diameter: 50px;
            width: var(--button-diameter);
            height: var(--button-diameter);
            border-radius: calc(var(--button-diameter)/2);
            padding: 0;
            margin-left: calc((100% - var(--button-diameter))/2);
            text-align:center;
        }
        .mailSideBar-newMessageModalButton-text{
            display: none;

        }
    }
    @media screen and (max-width: 400px) {
        /*.mailSideBar{
            margin-top: 0%;
            padding: 0;
            width: 100%;
            position: fixed;
            
            overflow: scroll;
            white-space: nowrap;
        }
        .mailSideBar-newMessageModalButton{
            margin-left: 0;
            display: inline;
            width:  20%;
            min-width:60px;

        }
        .mailSideBar-button {
            display: inline;
            width:  20%;
            min-width:60px;
        }
        .content{
 

            position: static;   
            margin-left: 0; 
        }*/

    }

    
</style>
<template> 

    
    <div class="view">
        <div class="mailSideBar">
  
            <div class="mailSideBar-buttonPart">


                <slot name="sideBarUpperAdditional"  ></slot>
                <button @click="showNewMessageModal = !showNewMessageModal;"  class="mailSideBar-newMessageModalButton"><va-icon name="add" /><span class="mailSideBar-newMessageModalButton-text">New Message</span> </button>
        
                <button @click="Inertia.visit(route('MyMessages'))"         :class="{ active: route().current('MyMessages') }"          class="mailSideBar-button"><va-icon name="inbox" />     <span class="mailSideBar-button-text">Received</span> </button>
                <button @click="Inertia.visit(route('SentMessages'))"       :class="{ active: route().current('SentMessages') }"        class="mailSideBar-button"><va-icon name="send" />      <span class="mailSideBar-button-text">Sent</span>      </button>
                <button @click="Inertia.visit(route('DraftMessages'))"      :class="{ active: route().current('DraftMessages')}"        class="mailSideBar-button"><va-icon name="drafts" />    <span class="mailSideBar-button-text">Draft</span>     </button>
                <button @click="Inertia.visit(route('TrashedMessages'))"    :class="{ active: route().current('TrashedMessages') }"     class="mailSideBar-button"><va-icon name="recycling" /> <span class="mailSideBar-button-text">Trashed</span>   </button>
                
                <div  class="mailSideBar-space"> </div>
                <button @click="Inertia.visit(route('ContactList'))"        :class="{ active: route().current('ContactList') }"         class="mailSideBar-button"><va-icon name="contacts" />  <span class="mailSideBar-button-text">Contact    </span>   </button>
                <button @click="Inertia.visit(route('PrivateCodeManager'))" :class="{ active: route().current('PrivateCodeManager') }"  class="mailSideBar-button"><va-icon name="vpn_key" />   <span class="mailSideBar-button-text">Private Key</span>   </button>


            </div>
        </div>
        <div class="content">
          <!--<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
              <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                  Messages
              </h2>
          </div>-->
  
          <div style="width:100%; height: 60px; display: block;"></div>
          <slot name="content" :tabName="currentTab"  ></slot>
          
        </div>
    </div>
    <FullScreenModal :show="showNewMessageModal" @close-button="showNewMessageModal=false">
        
      <NewMessageForm 
        :publicCode="publicCode" 
        :initialEventCode="null"
        @after-submission="showNewMessageModal=false;$vaToast.init({message: 'Message Sent', position: 'top-right'})"
        errorsBagName="newMessageForm"
        :errors="errors.newMessageForm"
      >
      </NewMessageForm>
    </FullScreenModal>
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
      showNewMessageModal: false
    }
  },
  methods: {
    /*changeTab(newTabName){
        this.currentTab=newTabName
    }*/
  }
}
</script>