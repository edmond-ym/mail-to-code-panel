

<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/
import ContactField from '../../js/Component/ContactField.vue'
import MailCodeContactConvertField from './MailCodeContactConvertField.vue'
import MailListItem from '../Component/MailListItem.vue'
defineProps({
    tableData:{ 
        type: Array,
    },
    superHeader:{
        type: Boolean,
        default: false
    }
});
defineEmits(['shortPressed', 'longPressed', 'backgroundClick', 'deleteClick']);
</script>
<style scope>
    .deleteButton{
        
        
        color: rgb(54, 69, 79);
        background-color: rgb(248,248,255);
        margin-top: 50%;
        border-radius: 15px;
        width: 30px;
        height: 30px;
    }
    .deleteButton:hover{
        background-color: rgb(54, 69, 79);
        color: rgb(248,248,255);
        
    }
</style>
<template>
    <div style=" overflow: auto;">
        <!--@background-click="$emit('pressed', item.id)"-->
        <div  v-for="(item, index) in tableData" :key="index">
            <MailListItem 
                @background-click="$emit('backgroundClick', item.id)"
                @background-key-up="backgroundKeyUp()"
                @background-key-down="backgroundKeyDown(item.id)"
                :contact="item.receiver_list"
                :datetime="item.created_at"
                :title="item.message.title"
                :paragraph="item.message.body"
                :rightBar="true"
                :superHeader="superHeader"
            >
                <template #superHeader>
                    <slot name="superHeader"/>                    
                </template>
                <template #rightBar>
                    <button class="deleteButton" @click="$emit('deleteClick', item.id)"><va-icon name="delete_forever" /></button>
                    
                </template>

            </MailListItem>
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
      backgroundKey:{
          startTime:0,
          endTime: 0
      }
  
    }
  },
  methods: {

    backgroundKeyDown(){
        /*this.endTime= 0
        this.startTime=0
        this.startTime=Date.now()*/
    },
    backgroundKeyUp(msg_id){
      
        /*this.endTime=Date.now()
        const timeLapsed=this.endTime - this.startTime
        const second=timeLapsed / 1000
        
        console.log(second)

        if (second>=1.5) {
            this.$emit('longPressed', msg_id)
        }else{
            console.log(msg_id)
            this.$emit('shortPressed', msg_id)
        }*/
        
    }
  }
}
</script>


