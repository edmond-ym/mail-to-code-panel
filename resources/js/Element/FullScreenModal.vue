<script setup>
defineProps({
    show:{
        type: Boolean,
        default: false
    },
    title:{
        type: String,
        default: null
    }
});
defineEmits(['closeButton']);
</script>

<template>
  <Transition name="modal">

    <div v-if="show" class="modal-background">
      <div class="modal-window">
       
        <div class="modal-window-header">
            <span @click="$emit('closeButton')" class="close-button">&times;</span>
            <h2>{{title}}</h2>
        </div>
        <div class="modal-window-body">
            <slot />
        </div>
      </div>
    </div>
  </Transition>

    
</template>






<style scope>

.modal-background {
  display: block; 
  position: fixed; 
  z-index: 1000; 
  padding-top: 0px; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
}

.modal-window {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: none;
  width: 100%;
  height: 100%;
}

.close-button {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.modal-window-header{
    display: block;
    width: 100%;
    height: 20px;
}
.modal-window-body{
    display: block;
    width: 100%;
    margin-top: 20px;
    position: static;
    height:80%;
    overflow: scroll;
}
.close-button:hover, .close-button:focus{
    cursor: pointer;
}

.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.5s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}
</style>




