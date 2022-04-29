<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import { Head } from '@inertiajs/inertia-vue3';
defineProps({
    role: Number,
    users: Array,
})
</script>

<template>
    <Head title="Roles" />

    <BreezeAuthenticatedLayout :role="role">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 w-2/3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-for="user in users" class="p-6 bg-white border-b border-gray-200" :key="user.id">
                        <div class="flex justify-between">
                            <div>{{ user.name }}</div>
                            <BreezeButton type="button" @click="changeRole(user)" :disabled="user.id===1">{{ roleLabel(user.role_id) }}</BreezeButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
export default{
    methods:{
        roleLabel(role_id){
            switch(role_id){
                case 3:
                    return 'Admin';
                case 2:
                    return 'Teacher';
                case 1:
                    return 'Student';
                default:
                    return 'Invalid';
            }
        },
        changeRole(user){
            const axios = require('axios').default;
            axios.post(`./roles/${user.id}`)
            .then(function(response){
                user.role_id = response.data.role_id;
            });
        }
    }
}
</script>
