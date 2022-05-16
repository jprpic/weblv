import Vuex from 'vuex'
import axios from "axios";
import actions from './actions'
import mutations from './mutations';

const store = new Vuex.Store({
    state () {
      return {
        auth: false,
        projects: []
      }
    },
    getter:{
      projects(state){
        return state.projects;
      }
    },
    mutations: mutations,
    actions: actions
})

export default store;
