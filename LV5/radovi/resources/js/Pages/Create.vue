<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    role: Number,
    trans: Object
})

const form = useForm({
    name: '',
    name_eng: '',
    description: '',
    studies: []
});

const submit = () => {
    form.post(route('teacher.tasks.store'));
};
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout :role="role">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ trans.create }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <form @submit.prevent="submit">
                            <div>
                                <BreezeLabel for="name" :value="trans.name" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="name_eng" :value="trans.name_eng" />
                                <BreezeInput id="name_eng" type="text" class="mt-1 block w-full" v-model="form.name_eng" required />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="description" :value="trans.description" />
                                <textarea v-model="form.description" class='mt-1 w-full block rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'></textarea>
                            </div>

                            <div class="block mt-4">
                                <label class="flex items-center">
                                    <BreezeCheckbox name="strucni" value="1" v-model:checked="form.studies" />
                                    <span class="ml-2 text-sm text-gray-600">{{ trans.strucni }}</span>
                                </label>
                                <label class="flex items-center">
                                    <BreezeCheckbox name="preddiplomski" value="2" v-model:checked="form.studies" />
                                    <span class="ml-2 text-sm text-gray-600">{{ trans.preddiplomski }}</span>
                                </label>
                                <label class="flex items-center">
                                    <BreezeCheckbox name="diplomski" value="3" v-model:checked="form.studies" />
                                    <span class="ml-2 text-sm text-gray-600">{{ trans.diplomski }}</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    {{ trans.submit }}
                                </BreezeButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>




<script>
export default {
    name: "Create"
}
</script>

<style scoped>

</style>
