<template>
    <div class="absolute left-12 top-10 overflow-x-auto w-11/12 shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Full Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Company
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data" :key="user.id" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ user.name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ user.company }}
                    </td>
                    <td class="px-6 py-4">
                        <router-link :to="{ path: '/worker/' + user.id  }" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
        <Pagination
        :data="users"
        @pagination-change-page="loadWorkers"
    />
    </div>
</template>

<script>
import axios from 'axios'
import { TailwindPagination } from 'laravel-vue-pagination';

export default {
    data() {
        return {
            users: {}
        };
    },
    methods: {
        loadWorkers(page = 1) {
            axios.get("http://localhost:8000/api/workers?page=" + page).then((response) => (this.users = response.data));
        }
    },
    mounted() {
        this.loadWorkers();
    },
    components: {
        'Pagination': TailwindPagination
    }
}
</script>

<style></style>