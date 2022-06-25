<script setup>

defineProps({
    searchField:{
        type: String,
        default: null
    },
});

defineEmits([
    'update:searchField',
    'searchUpdate'

]);

</script>

<template>

    <form @submit.prevent="submit">
      <div class="input-group mb-3" style="  z-index: 0; ">
        <input 
          :value="searchField"
          class="searchBarField " 
          placeholder="Search"
          @input="searchField=$event.target.value"
        >
        <button  
          
          v-show="searchField != null"
          class="searchBarClose" 
          type="button" 
          @click="$emit('searchUpdate', null);"
        ><va-icon name="close" /></button>

        <button  
          class="searchBarButton" 
          type="submit" 
          id="button-addon2"
          @click="$emit('searchUpdate', searchField);"
        ><va-icon name="search" /></button>
      </div>
    </form>


</template>
<style scope>
.searchBarField{
  border-radius: 0;
  border-width:1px;
  border-color: darkgray;
  flex: 1 1 auto;
  -ms-flex: 1 1 auto;
  border-right: none;
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left:10px;
}
.searchBarField:focus{
  outline: none;
  border-color: darkgray;

}
.searchBarButton{
  background-color:rgb(2, 105, 164);
  color: white;
  border-radius: 0;
  border: none;
  padding-left:10px;
  padding-right:10px;

}

.searchBarButton:hover{
  /*background-color:rgb(0, 180, 171);
  color: white;*/
  /*background-color:rgb(2, 105, 164);*/
  opacity: 0.8;
}
.searchBarClose{
  /*background-color:rgb(2, 105, 164);
  color: white;*/
  border-radius: 0;
  /*border: none;*/
  border-width: 1px;
  padding-left:10px;
  padding-right:10px;
  border-color: darkgray;
  border-left: 0;
  margin-left: 40px;

}

</style>
<script>
export default{
  methods(){

  }
}
</script>