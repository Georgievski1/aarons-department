<template>
  <div class="absolute left-12 top-10 overflow-x-auto w-11/12 shadow-md sm:rounded-lg">
    <button type="button" @click="toggleShow" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 float-right">Add Shift</button>
    <input type="text" v-model="filterShifts" @change="filterAction(filterShifts)" id="filter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Filter">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-5">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Worker
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Company
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Hours
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rate per Hour
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Taxable
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Shift Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Paid at
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="shift in shifts.data" :key="shift.id" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ shift.shift_date }}
                    </th>
                    <td class="px-6 py-4">
                        {{ shift.worker.name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ shift.worker.company }}
                    </td>
                    <td class="px-6 py-4">
                        {{ shift.hours }}
                    </td>
                    <td class="px-6 py-4">
                      £{{ shift.hour_rate }}
                    </td>
                    <td class="px-6 py-4">
                        {{ shift.taxable }}
                    </td>
                    <td class="px-6 py-4">
                        {{ shift.status }}
                    </td>
                    <td class="px-6 py-4">
                        {{ shift.shift_type }}
                    </td>
                    <td class="px-6 py-4">
                      {{ shift.paid }}
                    </td>
                    <td class="px-6 py-4">
                      £{{ shift.total }}
                    </td>
                    <td class="flex">
                        <button type="button" @click="activateEditModal(shift)" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 mr-1 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 mt-3 py-1 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Edit</button>
                        <button type="button" @click="deleteShift(shift.id)" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 mt-3 py-1 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <Pagination
        :data="shifts"
        @pagination-change-page="loadShifts"
    />

    <Modal v-bind="{show: show}" @close="toggleShow" />
    <EditModal :openEditModal="openEditModal" :shift="this.shift" @close="toggleEditModal" :worker="shift.worker" :loadShifts="loadShifts" />

    </div>
</template>

<script>
import axios from 'axios'
import { TailwindPagination } from 'laravel-vue-pagination';
import Modal from './Modal.vue';
import EditModal from './EditModal.vue';

export default {
    data() {
        return {
            shifts: {},
            show: false,
            openEditModal: false,
            shift: {},
        };
    },
    methods: {
        loadShifts(page = 1) {
            axios.get("http://localhost:8000/api/shifts?page=" + page).then((response) => (this.shifts = response.data));
        },
        activateEditModal(shift){
            this.openEditModal = true;
            this.shift = shift;
        },
        deleteShift(id){
            axios.delete("http://localhost:8000/api/shifts/delete/" + id)
        },
        filterAction(filterShifts) {
            axios.get("http://localhost:8000/api/shifts/" + filterShifts).then((response) => (this.shifts = response.data));
        },
        toggleShow() {
            this.show = !this.show
        },
        toggleEditModal() {
            this.openEditModal = !this.openEditModal
        }
    },
    mounted() {
        this.loadShifts();
    },
    components: {
        'Pagination': TailwindPagination,
        'Modal': Modal,
        'EditModal': EditModal
    }
}
</script>

<style>

</style>