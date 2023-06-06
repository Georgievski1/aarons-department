<template>
    <TransitionRoot as="template" :show="openEditModal">
      <Dialog as="div" class="relative z-10">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
          leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>
  
        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <TransitionChild as="template" enter="ease-out duration-300"
              enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
              enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
              leave-from="opacity-100 translate-y-0 sm:scale-100"
              leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
              
              <form>
              <DialogPanel
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                  <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                      <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">Edit Shift</DialogTitle>
                      <div class="mt-2">
                          <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                              <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
  
                              <div class="sm:col-span-3">
                                  <label for="shift_date" class="block text-sm font-medium leading-6 text-gray-900">Shift Date</label>
                                  <div class="mt-2">
                                    <input type="text" name="shift_date" id="shift_date" v-model="shift.shift_date" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                  </div>
                                </div>
                              </div>
  
                              <div class="sm:col-span-3">
                                <label for="worker" class="block text-sm font-medium leading-6 text-gray-900">Worker Full name</label>
                                <div class="mt-2">
                                  <input type="text" name="worker" id="worker" v-model="worker.name" autocomplete="worker" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                              </div>
  
                              <div class="sm:col-span-3">
                                <label for="user_company" class="block text-sm font-medium leading-6 text-gray-900">Worker Company name</label>
                                <div class="mt-2">
                                  <input type="text" name="user_company" id="user_company" v-model="worker.company" autocomplete="company" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                              </div>
  
                              <div class="sm:col-span-3">
                                <label for="hours" class="block text-sm font-medium leading-6 text-gray-900">Hours</label>
                                <div class="mt-2">
                                  <input type="text" name="hours" id="hours" v-model="shift.hours" autocomplete="hours" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                              </div>
  
                              <div class="sm:col-span-3">
                                <label for="rate" class="block text-sm font-medium leading-6 text-gray-900">Rate per Hour</label>
                                <div class="mt-2">
                                  <input type="text" name="rate" id="rate" v-model="shift.hour_rate" autocomplete="rate" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                              </div>
  
                              <div class="sm:col-span-3">
                                <label for="taxable" class="block text-sm font-medium leading-6 text-gray-900">Taxable</label>
                                <div class="mt-2">
                                  <input type="text" name="taxable" id="taxable" v-model="shift.taxable" autocomplete="taxable" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                              </div>
  
                              <div class="sm:col-span-3">
                                <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                                <div class="mt-2">
                                  <select id="status" name="status" v-model="shift.status" autocomplete="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option>Pending</option>
                                    <option>Complete</option>
                                  </select>
                                </div>
                              </div>
  
                              <div class="sm:col-span-3">
                                <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Shift Type</label>
                                <div class="mt-2">
                                  <select id="type" name="type" v-model="shift.shift_type" autocomplete="type" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option>Day</option>
                                    <option>Night</option>
                                  </select>
                                </div>
                              </div>
  
                              <div class="sm:col-span-3">
                                <label for="paid" class="block text-sm font-medium leading-6 text-gray-900">Paid At</label>
                                <div class="mt-2">
                                  <input type="text" name="paid" id="paid" v-model="shift.paid" autocomplete="paid" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                              </div>
  
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                  
                  <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 ml-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    @click.prevent="editShiftMethod(shift.id)" ref="cancelButtonRef">Edit</button>
                  <button type="button"
                    class="text-sm font-semibold leading-6 text-gray-900"
                    @click="closeEditModal">Cancel</button>
                </div>
              </DialogPanel>
              </form>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </template>
  
  <script>
  import { ref } from 'vue'
  import axios from 'axios'
  import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
  import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline'
  
  export default {
    props: ['openEditModal', 'shift', 'worker'],
    methods: {
        editShiftMethod(id) {
            this.shift.user_company = this.worker.company
            axios.put("http://localhost:8000/api/shifts/edit/" + id, this.shift)
            this.$emit('close')
        },
        closeEditModal() {
          this.$emit('close')
        }
    },
    components: {
      'Dialog': Dialog,
      'DialogPanel': DialogPanel,
      'DialogTitle': DialogTitle,
      'TransitionChild': TransitionChild,
      'TransitionRoot': TransitionRoot,
      'ExclamationTriangleIcon': ExclamationTriangleIcon,
    }
  }
  </script>
  
  <style></style>