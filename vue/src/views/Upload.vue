<template>
    <form class="space-y-6" @submit.prevent="fileUpload">
        <div class="mb-3">
            <label for="formFileLg" class="mb-2 inline-block text-neutral-700 dark:text-neutral-200">Upload your shifts csv
                file</label>
            <input
                class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] font-normal leading-[2.15] text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                id="formFileLg" type="file" @change="onChange" />
            <button type="submit"
                class="flex w-full mt-5 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Upload</button>
        </div>
    </form>
</template>

<script>
import axios from 'axios'

    export default{
        data() {
            return {
                filename: '',
                file: '',
            }
        },
        methods: {
            onChange(e) {
                this.filename = e.target.files[0].name
                this.file = e.target.files[0]
            },
            fileUpload(e){
                e.preventDefault();
                let currentObj = this;
   
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
    
                let formData = new FormData();
                formData.append('csv_file', this.file);
                axios.post('http://localhost:8000/api/upload', formData, config)
                .then(function (response) {
                    currentObj.success = response.data.success;
                    e.target.reset()
                    this.$router.push('/workers');
                }).catch(function (error) {
                    currentObj.output = error;
                });
            }
        }
    }
    
</script>