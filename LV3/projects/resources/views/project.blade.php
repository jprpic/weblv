<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <p> <span style="font-size: large;font-weight: bold">Team Lead: {{ $team_lead_name }}</span></p>
                        <a href="{{ route('edit', ['id' => $project->id]) }}">
                            <x-button :disabled="!($isLeader || $isMember)">Edit</x-button>
                        </a>
                    </div>
                    <p class="mt-1"> <b>Price: </b>{{ $project->price }} </p>
                    <p class="mt-1"> <b>Description: </b>{{ $project->description }} </p>
                    <div class="mt-1 flex justify-between">
                        <p> <b>Tasks done: </b>{{ $project->tasks_done }} </p>
                        <a href="{{ route('finish', ['id' => $project->id]) }}">
                            <x-button :disabled="!($isLeader)">Finish</x-button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="app">
                        <h2> <span style="font-size: large;font-weight: bold">Team Members:</span></h2>
                        <div class="flex">
                            <div class="p-2" v-for="member in team_members" :key="member.id">
                                <button @click="removeMember(member.id)" :disabled="!isLeader" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" >
                                    @{{ member.name }}
                                </button>
                            </div>
                        </div>

                        <h2> <span style="font-size: large;font-weight: bold">Add Members:</span></h2>
                        <div class="flex">
                            <div class="p-2" v-for="user in users" :key="user.id">
                                <button @click="addMember(user.id)" :disabled=!isLeader class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" >
                                    @{{ user.name }}
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


<script>
    Vue.createApp({
        data() {
            return {
                users: '',
                team_members: '',
            }
        },
        computed:{
            isLeader(){
                return {{ $project->team_lead_id }} === {{ Auth()->id() }};
            }
        },
        methods:{
            addMember(user_id){
                if(!this.isLeader){
                    return;
                }
                axios.post(`${location.origin}/project/user/store`,{
                    'project_id': {{ $project->id }},
                    'user_id': user_id
                }).then(function(response){
                    console.log(response);
                });
                this.fetchData();
            },
            removeMember(user_id){
                if(!this.isLeader){
                    return;
                }
                axios.post(`${location.origin}/project/user/destroy`,{
                    'project_id': {{ $project->id }},
                    'user_id': user_id
                }).then(function(response){
                    console.log(response);
                });
                this.fetchData();
            },
            async fetchData() {
                const [firstResponse, secondResponse] = await Promise.all([
                    axios.get(`${location.origin}/api/project/{{ $project->id }}/members`),
                    axios.get(`${location.origin}/api/project/{{ $project->id }}/availableUsers`)
                ])

                this.team_members = firstResponse.data;
                this.users = secondResponse.data;
            }
        },
        async created() {
            await this.fetchData();
        }
    }).mount('#app')
</script>
