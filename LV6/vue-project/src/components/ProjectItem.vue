<script setup>
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
    <div class="border-[#18A576] border rounded-md p-3">
        <div class="flex justify-between ">
            <div class="flex flex-col">
                <div>
                    <span class="span-prop">Name:&nbsp;</span> {{ name }}
                </div>
                <div>
                    <span class="span-prop">Price:&nbsp;</span> {{ price }}
                </div>
            </div>
            <div class="flex flex-col">
                <div>
                    <span class="span-prop">Created at:&nbsp;</span> {{ dateToString(created_at) }}
                </div>
                <div>
                    <span class="span-prop">Updated at:&nbsp;</span> {{ dateToString(updated_at) }}
                </div>
            </div>
        </div>
        <p><span class="span-prop">Tasks done:&nbsp;</span> {{ tasks_done }}</p>
        <p ><span class="span-prop">Description:&nbsp;</span> {{ description }}</p>
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
.span-prop{
    font-weight: bold;
    color: #18A576;
}
</style>