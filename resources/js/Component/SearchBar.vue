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
          class="form-control " 
          type="text" 
          placeholder="Search"
          @input="searchField=$event.target.value"
        >
        <button  
          class="btn btn-outline-secondary" 
          type="submit" 
          id="button-addon2"
          @click="$emit('searchUpdate', searchField);"
        >Search</button>
      </div>
    </form>


</template>

<script>
export default{
  
}
</script>