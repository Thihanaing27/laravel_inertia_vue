<template>
    <div class="mb-6">
        <label :for="label"> {{ name }} </label>
        <input
            :type="type"
            :id="label"
            v-model="model"
            :class="{ '!ring-red-500': message }"
        />
        <small class="error" v-if="message">{{ message }}</small>
    </div>
</template>

<script setup>
const model = defineModel({
    type: null,
    required: true,
});
defineProps({
    name: {
        type: String,
        Required: true,
    },
    type: {
        type: String,
        default: "text",
    },
    label: {
        type: String,
    },
    message: String,
});
</script>
