<script setup>
import TheButton from './TheButton.vue';
import { RouterLink } from 'vue-router';
const props = defineProps({
    id: Number,
    name: String,
    price: Number,
    tasks_done: String,
    description: String,
    created_at: Date,
    updated_at: Date
})
</script>

<template>
    <div class="rounded-lg p-3 project-item min-w-fit">
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
            <div class="flex flex-col flex-none min-w-fit w-3/12 px-2">
                <div>
                    <span>Created at:&nbsp;</span> {{ dateToString(created_at) }}
                </div>
                <div>
                    <span>Updated at:&nbsp;</span> {{ dateToString(updated_at) }}
                </div>
                <div class="flex justify-between mt-2">
                    <TheButton type="button" @click="redirect()"> Edit</TheButton>
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
        },
        redirect(){
            this.$router.push({name: 'update', params: { 
                id: this.id, 
                name: this.name,
                price: this.price,
                tasks_done: this.tasks_done,
                description: this.description,
            }});
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