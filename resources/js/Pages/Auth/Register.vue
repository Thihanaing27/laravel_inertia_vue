<template>
    <Head title="| Register" />
    <h1 class="title">Register a new account</h1>

    <div class="w-2/4 mx-auto">
        <form class="shadow-xl p-8 rounded-lg" @submit.prevent="submit">
            <div class="mx-auto w-64 text-center">
                <div class="relative w-40 mx-auto">
                    <img
                        class="w-40 h-40 rounded-full absolute bg-slate-200"
                        :src="form.preview ?? 'storage/avatars/default.png'"
                        alt=""
                    />
                    <div
                        class="w-40 h-40 group hover:bg-gray-200 opacity-60 rounded-full flex justify-center items-center cursor-pointer transition duration-500"
                    >
                        <input
                            type="file"
                            name="avatar"
                            id="avatar"
                            @input="change"
                            hidden
                            class="hidden group-hover:block w-12"
                            alt=""
                        />
                    </div>
                </div>
                <p class="error">{{ form.errors.avatar }}</p>
            </div>
            <!-- <div class="mb-4">
                <label for="avatar">Avatar</label>
                <input type="file" name="avatar" id="avatar" @input="change" />
                <p class="error">{{ form.errors.avatar }}</p>
            </div> -->
            <TextInput
                name="Name"
                label="name"
                v-model="form.name"
                :message="form.errors.name"
            />

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
            /><TextInput
                name="Confirm Password"
                label="password_confirmation"
                type="password"
                v-model="form.password_confirmation"
            />

            <div>
                <p class="text-slate-600 mb-2">
                    Already a user?
                    <a :href="route('login')" class="text-link">Login</a>
                </p>
            </div>
            <div>
                <button class="primary-btn" :disabled="form.processing">
                    Create
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { router, useForm } from "@inertiajs/vue3";
import TextInput from "../../Components/TextInput.vue";

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    avatar: null,
    preview: null,
});

const change = (e) => {
    // console.log(e);
    form.avatar = e.target.files[0];
    form.preview = URL.createObjectURL(e.target.files[0]);
};

const submit = () => {
    form.post(route("register"), {
        onError: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<style lang="scss" scoped></style>
