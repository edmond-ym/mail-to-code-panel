
<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/

defineProps({

    firstName:{
        type: String
    },
    lastName:{
        type: String
    },
    mailCodeList:{
        type: Array,
        default: false,
    },
    rightBar:{
        type: Boolean,
        default: false
    },
    superHeader:{
        type: Boolean,
        default: false
    }
});
defineEmits([
    'backgroundClick',
]);


</script>
<template>
   
    <div class="contact-card"  >
        <div 

            class="normal" 
            @click="$emit('backgroundClick')"
 
        >
            <div class="super-header" v-show="superHeader"  >
                    <slot name="superHeader" ></slot>
            </div>
            <!--<div class="header">
                <div class="header-item" >
                    
                </div>
                <div class="header-item" style="float: right;">
                    
                </div>
            </div>-->
            
            <div class="footer">
               <div class="footer-item name" >
                  {{firstName}} {{lastName}}
               </div>
               <br>
               <div class="footer-item mailCodeList">
                  <ul v-for="(mailCode, index) in mailCodeList" :key="index">
                    <li>{{mailCode}}</li>
                  </ul>
               </div>
            </div>
        </div>
        <div class="right-bar" v-if="rightBar" >
            <slot name="rightBar" ></slot>
        </div>

    </div>
</template>    	

<style scope>
    .right-bar{
        /*display: block;
        margin-bottom: 10px;*/
        /*width: 20%;
        min-width: 100px;
        max-width: 10%;*/
        padding-left:10px;
        padding-right:10px;

    }
    .header{
        display: block;
        /*height: 30px;*/
    }
    


    .contact-card{
        /*--normal-background-color:rgb(2, 105, 164);
        --unread-background-color:rgb(0, 180, 171);*/
        width: 100%;
        color: white;
        /*padding: 15px;*/
        display: flex;
        border-top: 1px solid white;
        border-bottom: 1px solid white;
    }
    .header-item{
        display: inline-block;
        font-size: 12px;
    }
    
    
    .footer-item{
       display: block;
        
    }
    .name{
        font-size: 16px;
    }
    .mailCodeList{
        font-size: 13px;
        max-width: 70%;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;

    }
    .normal:hover{
        opacity: 0.8;
        cursor: pointer;
    }
    .normal{
        padding: 15px;
        width: 100%;
        display: inline-block;
        background-color:rgb(2, 105, 164);

    }
    .super-header{
        width: 100%;
    }

    
</style>


   
    





<script>

export default {
    data(){
        return{
        } 
    }
}
</script>