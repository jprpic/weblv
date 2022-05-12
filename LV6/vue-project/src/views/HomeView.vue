<script setup>
import ProjectList from '../components/ProjectList.vue';
</script>

<template>
  <div>
    {{ response }}
  </div>
  <ProjectList :projects="projects"></ProjectList>
</template>

<script>
export default {
  name: "HomeView.vue",
  data(){
    return{
      projects : [
        {
          name: 'Lv5',
          description: 'Laboratorijska vjezba 5',
          price: 500,
          tasks_done: 'CRUD, Roles',
          created_at: new Date(Date.now()),
          updated_at: new Date(Date.now())
        },
        {
          name: 'Lv6',
          description: 'Laboratorijska vjezba 6 aaaaaaaa aaa aaaaaa aaaaa aaaaaaaa aaaaaaaaa aaaaaaa aaaaaaa aaaaaaaaaaaaaaa aaaaaaaaa',
          price: 100,
          tasks_done: 'Connection',
          created_at: new Date(Date.now()),
          updated_at: new Date(Date.now())
        },
      ],
      response : ''
    }
  },
  async mounted() {
    await this.axios.get(
      "http://localhost:4000/"
    ).then(response => (this.response = response.data))
  },
}
</script>