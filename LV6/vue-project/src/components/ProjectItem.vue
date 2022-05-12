<script setup>
import TheButton from './TheButton.vue';
    const props = defineProps({
        name: String,
        description: String,
        price: Number,
        tasks_done: String,
        created_at: Date,
        updated_at: Date
    })

</script>

<template>
    <div class="rounded-lg p-3 project-item">
        <div class="flex justify-between">
            <div class="flex flex-col">
                <div>
                    <span>Name:&nbsp;</span> {{ name }}
                </div>
                <div>
                    <span>Price:&nbsp;</span> {{ price }}
                </div>
                <p><span>Tasks done:&nbsp;</span> {{ tasks_done }}</p>
                <p><span>Description:&nbsp;</span> {{ description }}</p>
            </div>
            <div class="flex flex-col flex-none min-w-fit">
                <div>
                    <span>Created at:&nbsp;</span> {{ dateToString(created_at) }}
                </div>
                <div>
                    <span>Updated at:&nbsp;</span> {{ dateToString(updated_at) }}
                </div>
                <div class="self-end flex justify-between mt-2">
                    <TheButton class="mr-4"> Edit</TheButton>
                    <TheButton> Remove</TheButton>
                </div>
                
                
            </div>
        </div>
        
    </div>
    

</template>

<script>
export default {
    methods:{
        dateToString(date){
            return `${date.getDate()}.${date.getMonth()}.${date.getFullYear()}`;
        }
    }
}
</script>

<style scoped>
span{
    font-weight: bold;
    color: #18A576;
}
.project-item{
    background-color: var(--vt-c-divider-light-1);
}
</style>