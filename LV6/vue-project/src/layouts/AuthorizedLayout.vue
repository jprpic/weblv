<script setup>
import { RouterLink } from "vue-router";
</script>

<template>
    <div class="grid justify-items-center">
        <div class="pb-4">
            <header>
                <nav>
                    <RouterLink to="/">Home</RouterLink>
                    <RouterLink to="/create">Create</RouterLink>
                </nav>
            </header>  
        </div>
    </div>
</template>

