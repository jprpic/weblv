const mutations = {
    login (state) {
        state.auth = true;
    },
    logout(state){
        state.auth = false;
    },
    setProjects(state, projects){
      state.projects = projects;
    },
    addProject(state, project){
        state.projects.push(project);
    },
    deleteProject(state, id){
        state.projects = state.projects.filter(item => item._id !== id);
    },
    updateProject(state, project){
        let index = state.projects.findIndex(( object => object._id === project._id));
        state.projects.splice(index, 1, project);
    }
  }

export default mutations;