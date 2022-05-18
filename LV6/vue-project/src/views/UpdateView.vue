<template>
    <div class="w-3/4 form-div">
        <form @submit.prevent="submit">
            <div>
                <FormLabel value="Name"/>
                <FormInput v-model="project.name" id="name" name="name" type="text"/>
            </div>
            
            <div class="mt-2">
                <FormLabel value="Price"/>
                <FormInput v-model="project.price" id="price" name="price" type="number"/>
            </div>

            <div class="mt-2">
                <FormLabel value="Tasks Done"/>
                <FormInput v-model="project.tasks_done" id="tasks_done" name="tasks_done" type="text"/>
            </div>

            <div class="mt-2">
                <FormLabel value="Project Members"/>
                <FormInput v-model="project.members" id="members" name="members" type="text"/>
            </div>

            <div class="mt-2">
                <FormLabel class="mb-1" value="Description"/>
                <FromTextArea rows="3" v-model="project.description" />
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
import FormInput from "@/components/form/FormInput.vue";
import FormLabel from "@/components/form/FormLabel.vue";
import FromTextArea from "@/components/form/FromTextArea.vue";
import TheButton from "@/components/TheButton.vue";

export default {
  components: { FormInput, FormLabel, FromTextArea, TheButton },
  computed:{
      project(){
          return this.$store.getters.project(this.$route.params.id) ?? {};
      }
  },
  methods:{
      submit(){
        this.$store.dispatch('updateProject', {
            id: this.project._id,
            name: this.project.name,
            price: this.project.price,
            tasks_done: this.project.tasks_done,
            members: this.project.members,
            description: this.project.description
        });
        this.$router.push('/');
      }
  },
}
</script>

