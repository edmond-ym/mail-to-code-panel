<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import 'bootstrap' 
import NewPrivateCodeForm from '../../Module/NewPrivateCodeForm.vue'
import EditPrivateCodeInfoForm from '../../Module/EditPrivateCodeInfoForm.vue'
import PermanentlyDeletePrivateCodeForm from '../../Module/PermanentlyDeletePrivateCodeForm.vue'
import Button from '../../Element/Button.vue'
import Modal from '../../Element/Modal.vue'
import MailAppLayout from '@/Layouts/MailAppLayout.vue'
import MailSideBar from '../../Module/MailSideBar.vue'
import PrivateCodeCard from '../../Component/PrivateCodeCard.vue'
import EmptyListAlert from '../../Component/EmptyListAlert.vue'

</script>
<style scope>
    .rightBarButton{
        color: rgb(54, 69, 79);
        background-color: rgb(248,248,255);
        border-radius: 15px;
        width: 30px;
        height: 30px;
    }
    .rightBarButton:hover{
        background-color: rgb(54, 69, 79);
        color: rgb(248,248,255);
        
    }
</style>
<template>
    <MailAppLayout></MailAppLayout>

    <!--<AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Private Code Manager
            </h2>
        </template>-->
    <MailSideBar  :errors="errors" :publicCode="publicCode" >
      <template #content >
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                </div>
                
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-active-tab" data-bs-toggle="tab" data-bs-target="#nav-active" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Active</button>
                    <button class="nav-link" id="nav-trashed-tab" data-bs-toggle="tab" data-bs-target="#nav-trashed" type="button" role="tab" aria-controls="nav-trashed" aria-selected="false">Trashed</button>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-active" role="tabpanel" aria-labelledby="nav-active-tab" tabindex="0">
                    
                    <Button @click="showNewPrivateCodeModal = !showNewPrivateCodeModal">
                      New
                    </Button>
                    
                    <EmptyListAlert :show="privateCodeList.length==0">
                      No Mail Code
                    </EmptyListAlert>
                    <div style=" overflow: auto;">
                      <div v-for="(item, index) in privateCodeList" :key="index">
                        <PrivateCodeCard
                          :mailCode="publicCode+'-'+item.secret_code"
                          :nickname="item.nickname"
                          @background-click="EditPrivateCode.showModal = !EditPrivateCode.showModal;EditPrivateCode.currentNickname=item.nickname;EditPrivateCode.currentPrivateCode=item.secret_code"
                          backgroundClick="true"

                        >
                          <template #rightBar>
                            <button style="margin-top: 50%;" class="rightBarButton" @click="codeTrash(item.secret_code)"><va-icon name="delete" /></button>
                          </template>
                        </PrivateCodeCard>
                      </div>
                      <!--<table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Code</th>
                            <th scope="col">Nickname</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(item, index) in privateCodeList" :key="index">
                            <th scope="row">{{index+1}}</th>
                            <td>{{publicCode}}-{{item.secret_code}}</td>
                            <td>{{item.nickname}}</td>
                            <td>
                              <Button @click="EditPrivateCode.showModal = !EditPrivateCode.showModal;EditPrivateCode.currentNickname=item.nickname;EditPrivateCode.currentPrivateCode=item.secret_code ">
                                Edit
                              </Button>
                            </td>
                            <td>
                              <form  @submit.prevent="submit">
                                <Button type="submit" @click="codeTrash(item.secret_code)" color="danger" >Trash</Button>
                              </form>
                            </td>
                            
                          </tr>
                      
                        </tbody>
                      </table>-->
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nav-trashed" role="tabpanel" aria-labelledby="nav-trashed-tab" tabindex="0">
                    <EmptyListAlert :show="trashedPrivateCode.length==0">
                      No Mail Code
                    </EmptyListAlert>
                    <div v-for="(item, index) in trashedPrivateCode" :key="index">
                        <PrivateCodeCard
                          :mailCode="publicCode+'-'+item.secret_code"
                          :nickname="item.nickname"
                        >
                          <template #rightBar>
                            <div style="margin-top: 25%; padding-bottom: 25%; ">                            
                              <button  class="rightBarButton" @click="codeTrashedRestore(item.secret_code)"  ><va-icon name="restore_from_trash" /></button>
                            </div>
                            <div style="margin-bottom: 25%; padding-top: 25%; ">
                              <button  class="rightBarButton" @click="PermanentlyDeletePrivateCode.showModal = !PermanentlyDeletePrivateCode.showModal;PermanentlyDeletePrivateCode.currentPrivateCode=item.secret_code"><va-icon name="delete_forever" /></button>
                            </div>

                          </template>
                        </PrivateCodeCard>
                    </div>
                    <!--<table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Secret Code</th>
                          <th scope="col">Nickname</th>
                          <th scope="col">Deleted At</th>
                          <th scope="col"></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, index) in trashedPrivateCode" :key="index">
                          <th scope="row">{{index+1}}</th>
                          <td>{{publicCode}}-{{item.secret_code}}</td>
                          <td>{{item.nickname}}</td>
                          <td>{{item.deleted_at}}</td>

                          <td>
                            <form  @submit.prevent="submit" >
                              <button type="submit" @click="codeTrashedRestore(item.secret_code)" class="btn btn-success" >Restore</button>
                            </form>
                          </td>
                          <td>
                            <Button color="danger" @click="PermanentlyDeletePrivateCode.showModal = !PermanentlyDeletePrivateCode.showModal;PermanentlyDeletePrivateCode.currentPrivateCode=item.secret_code">
                              Permanently Delete
                            </Button>
                          </td>
                          
                        </tr>
                    
                      </tbody>
                    </table>-->
                    
                  </div>
                </div>
                  
                  
                
            </div>
           
        </div>
      </template>
    </MailSideBar> 
    <Modal v-model="showNewPrivateCodeModal"  title="New Private Code" hide-default-actions >
      <NewPrivateCodeForm 
        @close-window="showNewPrivateCodeModal=false; "
        @added="showNewPrivateCodeModal=false; $vaToast.init({message: 'Code Added', position: 'top-right'})"
        errorsBagName="newPrivateCodeForm"  
        :errors="errors.newPrivateCodeForm"
      ></NewPrivateCodeForm>
    </Modal>
    <Modal v-model="PermanentlyDeletePrivateCode.showModal"  title="Delete Private Code" hide-default-actions >
      <PermanentlyDeletePrivateCodeForm
        errorsBagName="PermanentlyDeletePrivateCodeForm"
        :errors="errors.PermanentlyDeletePrivateCodeForm"
        :PublicCode="publicCode"
        :PrivateCode="PermanentlyDeletePrivateCode.currentPrivateCode"
        @deleted-successfully="PermanentlyDeletePrivateCode.showModal=false;$vaToast.init({message: 'Code deleted!', position: 'top-right'})"
        @close-window="PermanentlyDeletePrivateCode.showModal=false;"
      ></PermanentlyDeletePrivateCodeForm>
    </Modal>
    <Modal v-model="EditPrivateCode.showModal"  title="New Private Code" hide-default-actions >

      <EditPrivateCodeInfoForm
         errorsBagName="editPrivateCodeInfoForm"
         :errors="errors.editPrivateCodeInfoForm"
         :currentNickname="EditPrivateCode.currentNickname"
         :PrivateCode="EditPrivateCode.currentPrivateCode"
         :PublicCode="publicCode"
         @updated-successfully="EditPrivateCode.showModal=false;$vaToast.init({message: 'Edited', position: 'top-right'})" 
         @close-window="EditPrivateCode.showModal=false;"
      ></EditPrivateCodeInfoForm>
    </Modal>
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
    privateCodeList: Array,
    publicCode: String,
    trashedPrivateCode: Array,
    
  },
  data() {
    return {
      showNewPrivateCodeModal: false,
      EditPrivateCode:{
        showModal: false,
        currentNickname: null,
        currentPrivateCode: null
      },
      PermanentlyDeletePrivateCode:{
        showModal: false,
        currentPublicCode: null,
        currentPrivateCode: null
      }
    }
  },
  methods: {
    codeTrash(secret_code){
      var nanobar = new Nanobar({
        classname: 'progress-bar',
        id: 'trash-progesss-bar',
      })
      nanobar.go(30);
      const form = useForm({
        secret_code: secret_code,
      })
      form.post(route('DeletePrivateCode'), {
        preserveScroll: true,
        onSuccess: () => {
          nanobar.go(100);
        },
      })
    },
    codeTrashedRestore(secret_code){
      var nanobar = new Nanobar({
        classname: 'progress-bar',
        id: 'trashRestore-progesss-bar',
      })
      nanobar.go(30);
      const form = useForm({
        secret_code: secret_code,
      })
      form.post(route('RestorePrivateCode'), {
        preserveScroll: true,
        onSuccess: () => {
          nanobar.go(100);
        },
      })
    }
  },
}
</script>