<template>
    <Head :title="`| ${$page.component}`" />
    <div class="flex justify-end mb-2">
        <div class="2/4">
            <input type="search" placeholder="Search" v-model="search" />
        </div>
    </div>
    <table class="table-auto">
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registration Date</th>
                <th v-if="can.delete_user">Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users.data" :key="user.id">
                <td>
                    <img
                        :src="
                            user.avatar
                                ? 'storage/' + user.avatar
                                : 'storage/avatars/default.png'
                        "
                        alt=""
                        class="avatar"
                    />
                </td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ formatDate(user.created_at) }}</td>
                <td v-if="can.delete_user">
                    <button class="bg-red-500 w-6 h-6 rounded-full"></button>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="flex justify-between items-center">
        <div>
            <Link
                v-for="link in users.links"
                :key="link.label"
                v-html="link.label"
                :href="link.url"
                class="p-1 mx-1"
                :class="{
                    'text-slate-200': !link.url,
                    'text-blue-500 font-medium': link.active,
                }"
            ></Link>
        </div>
        <p class="text-skate-500 text-sm">
            Showing {{ users.from }} to {{ users.to }} of
            {{ users.total }} result
        </p>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { debounce } from "lodash";

const props = defineProps({
    users: Object,
    searchTerm: String,
    can: Object,
});

const search = ref(props.searchTerm);

watch(
    search,
    debounce(
        (q) => router.get("/", { search: q }, { preserveState: true }),
        500
    )
);
function formatDate(isoDate, options = {}) {
    const date = new Date(isoDate);
    const defaultOptions = {
        year: "numeric",
        month: "long", // 'long', 'short', or 'numeric'
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    };

    const formatOptions = { ...defaultOptions, ...options };

    return date.toLocaleString("en-US", formatOptions);
}
</script>
