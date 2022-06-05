<script setup>
/*defineProps({
    field:{
        type: Array,
    },
    data:{
        type: Array,
    }
});*/
</script>

<!--<template>
  <table  class="va-table va-table--clickable">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
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
  </table>
   
    
</template>-->
