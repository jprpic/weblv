<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id="projects">

                </div>
            </div>

        </div>
    </div>


</x-app-layout>

<script>
    Vue.createApp({
        template:
            '<div v-for="project in projects" :key="project.id">' +
                '<div class="p-6 bg-white border-b border-gray-200">' +
                    '<a :href=`./project/${project.id}`><span style="font-weight: bold; font-size: large">@{{ project.name }}</span></a>' +
                    '<p>@{{ project.description }}</p>' +
                '</div>'+
            '</div>',

        data() {
            return {
                projects: '',
            }
        },
        mounted() {
            axios.get(`${location.origin}/api/projects`).
            then((response) => this.projects = response.data);
        }
    }).mount('#projects')
</script>
