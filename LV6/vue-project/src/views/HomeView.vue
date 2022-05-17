<script setup>
import ProjectList from '../components/ProjectList.vue';
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
const config = {
  withCredentials: true,
  headers: {
    'Content-Type': 'application/json',
  },
};
export default {
  name: "HomeView.vue",
  computed:{
    projects(){
      return this.$store.state.projects;
    }
  },
  methods:{
    async getSession(){
      await this.axios.get('http://localhost:4000/api/user',config)
        .then(res => {
          console.log(res);
        })
    },
    async logout(){
      await this.axios.get('http://localhost:4000/api/logout',config)
        .then(res => {
          console.log(res);
        })
    }
  }
}
</script>