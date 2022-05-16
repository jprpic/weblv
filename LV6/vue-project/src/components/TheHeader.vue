<script setup>
import GuestLayout from "../layouts/GuestLayout.vue";
import AuthorizedLayout from "../layouts/AuthorizedLayout.vue";
</script>

<template>
    <div v-if="this.$store.state.auth">
        <AuthorizedLayout />
    </div>
    <div v-else>
        <GuestLayout />
    </div>
</template>
