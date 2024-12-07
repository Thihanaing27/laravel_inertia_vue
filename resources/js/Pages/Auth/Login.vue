<template>
    <Head title="| Register" />
    <h1 class="title">Login to your account</h1>

    <div class="w-2/4 mx-auto">
        <form class="shadow-xl p-8 rounded-lg" @submit.prevent="submit">
            <TextInput
                name="Email"
                label="email"
                v-model="form.email"
                :message="form.errors.email"
            />

            <TextInput
                name="Password"
                label="password"
                type="password"
                v-model="form.password"
                :message="form.errors.password"
            />
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-1">
                    <input
                        type="checkbox"
                        id="remember"
                        v-model="form.remember"
                    />
                    <label for="remember">remember me?</label>
                </div>
                <p class="text-slate-600 mb-2">
                    need an account?
                    <a :href="route('register')" class="text-link">Create</a>
                </p>
            </div>
            <div>
                <button class="primary-btn" :disabled="form.processing">
                    Login
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "../../Components/TextInput.vue";

const form = useForm({
    email: null,
    password: null,
    remember: null,
});

const submit = () => {
    form.post(route("login"), {
        onError: () => form.reset("password"),
    });
};
</script>

<style lang="scss" scoped></style>
