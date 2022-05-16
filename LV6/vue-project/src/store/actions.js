import axios from "axios"

const actions = {
    // AUTH
    login(context) {
      context.commit('login')
      context.dispatch('readProjects');
    },
    logout(context) {
      context.commit('logout')
    },
    // PROJECTS CRUD
    async readProjects(context){
        await axios.get(
          "http://localhost:4000/api/projects"
        ).then(response => {
          context.commit('setProjects', response.data)
        })
    },
    async createProject(context, project){
        await axios.post("http://localhost:4000/api/projects", project)
          .then(response => {
              context.commit('addProject', response.data);
          })
          .catch(err => {
              console.log(err);
          });
    },
    async updateProject(context, project){
        await axios.put(`http://localhost:4000/api/projects/${project.id}`, {
                name: project.name,
                price: project.price,
                tasks_done: project.tasks_done,
                members: project.members,
                description: project.description
            })
            .then(response => {
                context.commit('updateProject', response.data);
            })
            .catch(err => {
                console.log(err);
            });
    },
    async deleteProject(context, id){
        await axios.delete(`http://localhost:4000/api/projects/${id}`)
            .then(res => {
                context.commit('deleteProject', id);
            })
            .catch(err => {
                console.log(err)
            })
    }
}

export default actions;