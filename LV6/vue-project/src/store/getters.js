const getters = {
    projects(state){
      return state.projects;
    },
    auth(state){
      return state.user.auth;
    },
    username(state){
      return state.user.username;
    },
    project: (state) => (id) => {
        return state.projects.find(x => x._id === id);
    }
  }

export default getters; 