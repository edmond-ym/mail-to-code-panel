<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <!--<button :type="type" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
        <slot />
    </button>-->

    <button :type="type" class="JetStreamSecondaryButton">
        <slot />
    </button>
</template>


<style scope>
.JetStreamSecondaryButton{
    background-color: white;
    border: 1px solid rgb(2, 105, 164);
    color: rgb(2, 105, 164);
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 10px;
    padding-bottom: 10px;

}

</style>
