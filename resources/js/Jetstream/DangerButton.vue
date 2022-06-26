<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <!--<button :type="type" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
        <slot />
    </button>-->
    <button :type="type" class="JetStreamDangerButton">
        <slot />
    </button>
</template>
<style scope>
.JetStreamDangerButton{
    background-color: rgb(196, 30, 58);
    color: white;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 10px;
    padding-bottom: 10px;

}
</style>