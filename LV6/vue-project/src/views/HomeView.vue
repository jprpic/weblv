<script setup>
import ProjectList from '../components/ProjectList.vue';
</script>

<template>
  <ProjectList :projects="projects"></ProjectList>
</template>

<script>
export default {
  name: "HomeView.vue",
  computed:{
    projects(){
      return this.$store.state.projects;
    }
  },
}
</script>