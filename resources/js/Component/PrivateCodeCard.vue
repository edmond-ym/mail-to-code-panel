
<script setup>

/*import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';*/

defineProps({
    /*data:{
        type: Object
    }*/
    mailCode:{
        type: String
    },
    nickname:{
        type: String
    },
    
    superHeader:{
        type: Boolean,
        default: false
    },
    deleted_at:{
        type: String,
        default: null
    },
    backgroundClick:{
        type: Boolean,
        default: false
    }
});
defineEmits([
    'backgroundClick',
]);


</script>

<template>
   
    <div class="mail-list-item" 
   
       
    >
        
  

        <div 
           
            class="normal " 
            :class="{'normal-hover': backgroundClick}"
            @click="$emit('backgroundClick')"

        >
            <div class="super-header" v-show="superHeader"  >
        
    
                    <slot name="superHeader" ></slot>
            </div>
            <div class="header">
                <div class="header-item" >
                   
                </div>
                <div class="header-item" style="float: right;">
                   <div v-show="deleted_at!=null">
                       {{deleted_at}}
                   </div>
                </div>
            </div>
            
            <div class="footer">
                <div class="footer-item title" >
                    {{nickname}}
                </div>
                <div class="footer-item para">
                    {{mailCode}}
                </div>
            </div>
        </div>
        <div class="right-bar"   >
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
        background-color:rgb(2, 105, 164);
    }
    .header{
        display: block;
        /*height: 30px;*/
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
    .normal-hover:hover{
        opacity: 0.8;cursor: pointer;
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