<script setup>
import ProjectList from '../components/project/ProjectList.vue';
</script>

<template>
  <ProjectList :projects="projects"></ProjectList>
</template>

<script>
export default {
  name: "ProjectsView.vue",
  computed:{
    projects(){
        let projects = this.$store.getters.projects;
        const user = this.$store.getters.user;
        if(user && projects){
            // Projects where current user is a member
            console.log(projects);
            projects = projects.filter(project => project.members.find(member => member._id === user.id));
            // Projects where current user isn't the owner
            return projects.filter(project => project.owner.id !== user.id);
        }
        return {};
    }
  },
}
</script>