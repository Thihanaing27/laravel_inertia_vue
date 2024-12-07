<template>
    <p v-if="$page.props.flash?.greet" class="p-1 bg-green-300 text-green-900">
        {{ $page.props.flash.greet }}
    </p>
    <div>
        <h1 class="title">Welcome back {{ $page.props.auth.user?.name }}</h1>
    </div>
</template>

<script setup></script>

<style lang="scss" scoped></style>
