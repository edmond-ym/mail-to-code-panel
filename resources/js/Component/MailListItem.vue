
<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/

defineProps({
    /*data:{
        type: Object
    }*/
    contact:{
        type: String
    },
    datetime:{
        type: String
    },
    title:{
        type: String
    },
    paragraph:{
        type: String
    },
    unread:{
        type: Boolean,
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
    'backgroundKeyUp',
    'backgroundKeyDown'

]);


</script>
<template>
   
    <div class="mail-list-item" 
   
       
    >
        
  

        <div 
            :class="{ 'mail-list-item-normal': !unread, 'mail-list-item-unread': unread }" 
            class="normal" 
            @click="$emit('backgroundClick')"
            @mouseup="$emit('backgroundKeyUp')"
            @mousedown="$emit('backgroundKeyDown')"
        >
            <div class="super-header" v-show="superHeader"  :class="{ 'mail-list-item-normal': !unread, 'mail-list-item-unread': unread }" >
        
    
                    <slot name="superHeader" ></slot>
            </div>
            <div class="header">
                <div class="header-item" >
                    {{contact}}
                </div>
                <div class="header-item" style="float: right;">
                    {{datetime}}
                </div>
            </div>
            
            <div class="footer">
               <div class="footer-item title" >
                   <div v-if="title==null">NULL</div>
                   <div v-else> {{title}}</div>
               </div>
               <div class="footer-item para">
                   <div v-if="paragraph==null">NULL</div>
                   <div v-else> {{paragraph}}</div>
               </div>
            </div>
        </div>
        <div class="right-bar" v-if="rightBar" :class="{ 'mail-list-item-normal': !unread, 'mail-list-item-unread': unread }" >
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
    
    .mail-list-item-normal{
        background-color:rgb(2, 105, 164);
    }
    .mail-list-item-unread{
        background-color:rgb(0, 180, 171);
    }
    .mail-list-item{
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
    .title{
        font-size: 16px;
    }
    .para{
        font-size: 13px;
        text-overflow: ellipsis;
        white-space: clip;
        overflow: hidden;
        display: -webkit-box; 
        -webkit-line-clamp: 2; 
        -webkit-box-orient: vertical;
       
    }
    .normal:hover{
        opacity: 0.8;
        cursor: pointer;
    }
    .normal{
        padding: 15px;
        width: 100%;
        display: inline-block;
        

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