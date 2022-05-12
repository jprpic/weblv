<script setup>
import ProjectItem from './ProjectItem.vue';
const props = defineProps({
    projects: Array
})
</script>

<template>
    <div class="w-2/3">
        <div v-for="project in projects" class="mb-4" :key="project.id">
            <ProjectItem v-bind="project"/>
        </div>
    </div>
</template>