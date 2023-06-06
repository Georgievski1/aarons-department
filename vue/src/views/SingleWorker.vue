<template>
  <div class="absolute left-12 top-10 overflow-x-auto w-11/12 shadow-md sm:rounded-lg">
      <div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Full Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Average pay per hour
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Average total payment
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ worker.name }}
                    </th>
                    <td class="px-6 py-4">
                      £{{ avgPerHour }}
                    </td>
                    <td class="px-6 py-4">
                      £{{ avgTotal }}
                    </td>
                </tr>
            </tbody>
        </table>
      </div>
      <div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                </tr>
            </thead>
            <tbody>
                <tr v-for="completedShift in completedShifts" :key="completedShift.id" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ completedShift.shift_date }}
                    </th>
                    <td class="px-6 py-4">
                        {{ worker.name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ worker.company }}
                    </td>
                    <td class="px-6 py-4">
                        {{ completedShift.hours }}
                    </td>
                    <td class="px-6 py-4">
                      £{{ completedShift.hour_rate }}
                    </td>
                    <td class="px-6 py-4">
                        {{ completedShift.taxable }}
                    </td>
                    <td class="px-6 py-4">
                        {{ completedShift.status }}
                    </td>
                    <td class="px-6 py-4">
                        {{ completedShift.shift_type }}
                    </td>
                    <td class="px-6 py-4">
                      {{ completedShift.paid }}
                    </td>
                    <td class="px-6 py-4">
                      £{{ completedShift.total }}
                    </td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>
  
</template>

<script>
import axios from 'axios'

export default {
  data() {
        return {
            worker: {},
            avgPerHour: null,
            avgTotal: null,
            completedShifts: {},
        };
    },
    methods: {
        loadWorker() {
            axios.get("http://localhost:8000/api/worker/" + this.$route.params.id)
            .then((response) => (this.worker = response.data.worker, this.avgPerHour = response.data.avgPerHour, this.avgTotal = response.data.avgTotal, this.completedShifts = response.data.completedShifts ));
        }
    },
    mounted() {
        this.loadWorker();
    }
}
</script>

<style>

</style>