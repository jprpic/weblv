<script setup>
import { RouterLink } from "vue-router";
</script>

<template>
    <div class="grid justify-items-between pb-4">
        <div>
            <header>
                <nav>
                    <RouterLink to="/">Home</RouterLink>
                    <RouterLink to="/create">Create</RouterLink>
                    <RouterLink to="/projects">Projects</RouterLink>
                </nav>
            </header>  
        </div>
        <div>
            <span>
                {{ this.$store.getters.user.username }}
            </span>
        </div>
    </div>
</template>

