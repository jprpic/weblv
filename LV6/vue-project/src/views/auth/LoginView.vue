<template>
    <div class="w-1/3">
        <form @submit.prevent="login" class="" >
            <div>
                <FormLabel value="Username"/>
                <FormInput v-model="username" id="username" name="username" type="text" class="w-full"/>
            </div>
            
            <div class="mt-2">
                <FormLabel value="Password"/>
                <FormInput v-model="password" id="password" name="password" type="text" class="w-full"/>
            </div>

            <div class="grid justify-items-stretch mt-4">
                <div class="justify-self-end">
                    <TheButton>Log In</TheButton>
                </div>
            </div>
        </form>
    </div>

</template>


<script>
import FormInput from "@/components/FormInput.vue";
import FormLabel from "@/components/FormLabel.vue";
import FromTextArea from "@/components/FromTextArea.vue";
import TheButton from "@/components/TheButton.vue";

export default{
    components: { FormInput, FormLabel, FromTextArea, TheButton },
    data(){
        return{
            username: '',
            password: '',
        }
    },
    methods:{
        login(){
            this.$store.dispatch('login');
            this.$router.push('/');
        }
    }
}

</script>
