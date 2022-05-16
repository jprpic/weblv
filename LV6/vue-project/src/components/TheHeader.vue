<script setup>
import UnauthorizedLayout from "../layouts/UnauthorizedLayout.vue";
import AuthorizedLayout from "../layouts/AuthorizedLayout.vue";

const props = defineProps({
    auth: Boolean  
})
</script>

<template>
    <div v-if="!auth">
        <UnauthorizedLayout />
    </div>
    <div v-else>
        <AuthorizedLayout />
    </div>
</template>
