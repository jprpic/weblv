<script>
import FormInput from "../components/FormInput.vue";
import FormLabel from "../components/FormLabel.vue";
import FromTextArea from "../components/FromTextArea.vue";
import TheButton from "../components/TheButton.vue";

export default {
  components: { FormInput, FormLabel, FromTextArea, TheButton },
  data() {
    return {
      name: '',
      price: 0,
      tasks_done: '',
      description: ''
    }
  },
  methods:{
      submit(){
          console.log("Submit!");
      }
  }
}
</script>

<template>
    <div class="w-3/4 form-div  rounded-lg">
        <form @submit.prevent="submit" class="p-4">
            <div>
                <FormLabel value="Name"/>
                <FormInput v-model="name" id="name" name="name" type="text"/> {{ name }}
            </div>
            
            <div class="mt-2">
                <FormLabel value="Price"/>
                <FormInput v-model="price" id="price" name="price" type="number"/> {{ price }}
            </div>

            <div class="mt-2">
                <FormLabel value="Description"/>
                <FromTextArea rows="5" v-model="description" /> {{ description }}
            </div>

            <div class="grid justify-items-stretch mt-2">
                <div class="justify-self-end">
                    <TheButton>Submit</TheButton>
                </div>
            </div>
            
        </form>
    </div>
</template>


<style scoped>

.form-div{
    background-color: var(--vt-c-divider-light-1);
}

</style>
