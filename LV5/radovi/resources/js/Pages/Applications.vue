<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    role: Number,
    tasks: Array,
})
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout :role="role">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Applications
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-for="task in tasks" class="p-6 bg-white border-b border-gray-200" :key="task.id">
                        <h2 style="font-size: large; font-weight: bold"> {{ task.name }} </h2>
                        <div class="pt-2">
                            <div v-if="task.user">
                                Taken by: <BreezeButton type="button" @click="removeStudent(task.id, task.user.id)"> {{ task.user.name }}</BreezeButton>
                            </div>
                            <div v-else class="flex">
                                <div v-for="applicant in task.applicants" class="pr-2">
                                    <BreezeButton type="button" @click="assignStudent(task.id, applicant.id)"> {{ applicant.name }}</BreezeButton>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'
export default {
    name: "Applications",
    methods:{
        assignStudent(task_id, student_id){
            const axios = require('axios').default;
            axios.post(route('teacher.tasks.student.store', task_id),{
                user_id: student_id
            });
            Inertia.reload({ only: ['tasks'] })
        },
        removeStudent(task_id, student_id){
            const axios = require('axios').default;
            axios.post(route('teacher.tasks.student.destroy', task_id),{
                user_id: student_id
            });
            Inertia.reload({ only: ['tasks'] })
        }
    }
}
</script>

<style scoped>

</style>
