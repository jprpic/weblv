<script setup>
import ProjectItem from './ProjectItem.vue';
const props = defineProps({
    projects: Array
})
</script>

<template>
    <div class="w-2/3">
        <div v-for="project in projects" class="my-2">
            <ProjectItem v-bind="project"/>
        </div>
    </div>
</template>