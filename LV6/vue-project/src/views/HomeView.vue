<script setup>
import { render } from 'vue';
import ProjectList from '../components/ProjectList.vue';
</script>

<template>
  <ProjectList :projects="projects" @project-remove="deleteProject"></ProjectList>
</template>

<script>
export default {
  name: "HomeView.vue",
  data(){
    return{
      projects : []
    }
  },
  async mounted() {
    await this.axios.get(
      "http://localhost:4000/api/projects"
    ).then(response => {
      this.projects = response.data})
  },
  methods:{
    deleteProject(id){
      this.projects = this.projects.filter(item => item._id !== id);
      console.log(this.projects);
    }
  }
}
</script>