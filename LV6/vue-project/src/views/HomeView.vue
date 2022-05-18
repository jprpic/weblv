<script setup>
import ProjectList from '../components/project/ProjectList.vue';
</script>

<template>
  <ProjectList :projects="projects"></ProjectList>

  <button type="button" @click="getSession">Session</button>
  <br>
  <br>
  <br>
  <button type="button" @click="logout">Logout</button>
</template>

<script>
export default {
  name: "HomeView.vue",
  computed:{
    projects(){
      return this.$store.getters.projects;
    }
  },
  methods:{
    async getSession(){
      await this.axios.get('http://localhost:4000/api/user')
        .then(res => {
          console.log(res);
        })
        .catch(err => {
          console.log(err)
        })
    },
    async logout(){
      await this.axios.get('http://localhost:4000/api/logout')
        .then(res => {
          console.log(res.data);
          this.$store.dispatch('logout');
          this.$router.replace({path: '/login'});
        })
        .catch(err => {
          console.log(err)
        })
    }
  }
}
</script>