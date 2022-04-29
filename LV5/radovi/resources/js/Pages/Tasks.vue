<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import { Head } from '@inertiajs/inertia-vue3';
defineProps({
    role: Number,
    tasks: Array,
    applied_tasks: Array,
    accepted_task: Number,
})
</script>

<template>
    <Head title="Roles" />

    <BreezeAuthenticatedLayout :role="role">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tasks
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-for="task in tasks" class="p-6 bg-white border-b border-gray-200" :key="task.id">
                        <div class="flex justify-between">
                            <div>
                                <h2 style="font-size: large; font-weight: bold"> {{ task.name }}</h2>
                                <p> <span style="font-size: smaller; font-weight: lighter;font-style: italic"> {{ task.name_eng }} </span><br>
                                <span style="font-weight: bold">Teacher: </span> {{ task.teacher }}
                                </p>
                            </div>
                            <div class="flex flex-col items-stretch">
                                <div><span v-for="study in task.studies">{{ study }}&nbsp; </span></div>
                                <div class="self-end py-2">
                                    <BreezeButton type="button" @click="apply(task.id)" :disabled="accepted_task">
                                        {{ applyLabel(task.id) }}
                                    </BreezeButton>
                                </div>
                            </div>
                        </div>
                        <p class="py-2">
                            <span style="font-weight: bold">Task: </span>{{ task.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
export default {
    name: "Tasks",
    methods:{
        apply(task_id){
            const axios = require('axios').default;
            if(!this.applied_tasks.includes(task_id)){
                axios.post(`./store/${task_id}`);
                this.applied_tasks.push(task_id);

            }else{
                axios.delete(`./tasks/${task_id}`);
                this.applied_tasks.splice(this.applied_tasks.indexOf(task_id), 1);
            }
        },
        applyLabel(task_id){
            return this.accepted_task === task_id ? 'Accepted' : this.applied_tasks.includes(task_id) ? 'Applied' : 'Apply';
        }
    }
}
</script>

<style scoped>

</style>
