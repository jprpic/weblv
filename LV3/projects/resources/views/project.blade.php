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
                    <p> <span style="font-size: large;font-weight: bold">Team Lead: {{ $team_lead_name }}</span></p>
                    <p class="mt-1"> <b>Price: </b>{{ $project->price }} </p>
                    <p class="mt-1"> <b>Description: </b>{{ $project->description }} </p>
                    <p class="mt-1"> <b>Tasks done: </b>{{ $project->tasks_done }} </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="app">
                        <div v-for="member in team_members">
                            <button>
                                @{{ member.name }}
                            </button>
                            </br>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script src="https://unpkg.com/vue@3"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
    Vue.createApp({
        data() {
            return {
                team_members: '',
            }
        },
        mounted () {
            axios
                .get(`${location.origin}/api/users`)
                .then(response => (this.team_members = response.data))
        }
    }).mount('#app')
</script>
