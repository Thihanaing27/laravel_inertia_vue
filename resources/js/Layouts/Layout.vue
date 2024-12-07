<template>
    <div>
        <header class="">
            <nav class="">
                <div class="space-x-6">
                    <Link
                        :href="route('home')"
                        class="nav-link"
                        :class="{ 'bg-slate-700': $page.component === 'Home' }"
                    >
                        Home
                    </Link>
                </div>
                <div
                    class="flex space-x-6 items-center"
                    v-if="$page.props.auth.user"
                >
                    <img
                        :src="
                            $page.props.auth.user.avatar
                                ? 'storage/' + $page.props.auth.user.avatar
                                : 'storage/avatars/default.png'
                        "
                        class="avatar cursor-pointer select-none hover:scale-110 hover:border-red-300 hover:border-2"
                        alt=""
                    />
                    <Link
                        :href="route('dashboard')"
                        class="nav-link"
                        :class="{
                            'bg-slate-700': $page.component === 'Dashboard',
                        }"
                    >
                        Dashboard
                    </Link>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        type="button"
                        class="nav-link"
                    >
                        Logout
                    </Link>
                </div>
                <div v-else class="space-x-6">
                    <Link
                        :href="route('login')"
                        class="nav-link"
                        :class="{
                            'bg-slate-700': $page.component === 'Auth/Login',
                        }"
                    >
                        Login
                    </Link>
                    <Link
                        :href="route('register')"
                        class="nav-link"
                        :class="{
                            'bg-slate-700': $page.component === 'Auth/Register',
                        }"
                    >
                        Register
                    </Link>
                </div>
            </nav>
        </header>
        <main class="p-4">
            <slot />
        </main>
    </div>
</template>

<script setup>
import { route } from "../../../vendor/tightenco/ziggy/src/js";
</script>

<style lang="scss" scoped></style>
