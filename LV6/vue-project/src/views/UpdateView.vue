<template>
    <div class="w-3/4 form-div">
        <form @submit.prevent="submit">
            <div>
                <FormLabel value="Name"/>
                <FormInput v-model="name" id="name" name="name" type="text"/>
            </div>
            
            <div class="mt-2">
                <FormLabel value="Price"/>
                <FormInput v-model="price" id="price" name="price" type="number"/>
            </div>

            <div class="mt-2">
                <FormLabel value="Tasks Done"/>
                <FormInput v-model="tasks_done" id="tasks_done" name="tasks_done" type="text"/>
            </div>

            <div class="mt-2">
                <FormLabel value="Project Members"/>
                <FormInput v-model="members" id="members" name="members" type="text"/>
            </div>

            <div class="mt-2">
                <FormLabel class="mb-1" value="Description"/>
                <FromTextArea rows="3" v-model="description" />
            </div>

            <div class="grid justify-items-stretch mt-2">
                <div class="justify-self-end">
                    <TheButton>Submit</TheButton>
                </div>
            </div>
            
        </form>
    </div>
</template>

<script>
import FormInput from "../components/FormInput.vue";
import FormLabel from "../components/FormLabel.vue";
import FromTextArea from "../components/FromTextArea.vue";
import TheButton from "../components/TheButton.vue";

export default {
  components: { FormInput, FormLabel, FromTextArea, TheButton },
  props:{
      id: String,
      name: String,
      price: Number,
      tasks_done: String,
      members: String,
      description: String
  },
  methods:{
      submit(){
        this.$store.dispatch('updateProject', {
            id: this.id,
            name: this.name,
            price: this.price,
            tasks_done: this.tasks_done,
            members: this.members,
            description: this.description
        });
        this.$router.push('/');
      }
  }
}
</script>

