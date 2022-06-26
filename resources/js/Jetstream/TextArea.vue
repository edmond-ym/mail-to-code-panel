<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <!--<input
        ref="input"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >-->
    <!--<input
        ref="input"
        class="JetStreamInput"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >-->
    <textarea 
        class="JetStreamTextArea" 
        ref="input"
        v-model="modelValue" 
        @input="$emit('update:modelValue', $event.target.value)"
    >
    </textarea>

</template>

<style scope>
.JetStreamTextArea{
  border-radius: 0;
  border-width:1px;
  border-color: darkgray;
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left:10px;
  padding-right:10px;
  background-color: white;
}
.JetStreamTextArea:focus{
  outline: none;
  border-color: darkgray;

}
</style>