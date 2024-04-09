
<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <h3 class="mt-5 text-dark text-center text-4xl">vue crud test app</h3>
                </div>
                <div class="card-header text-2xl text-gray-400 px-6">
                    Add Record
                </div>
                <div class="card-body">
                    <form @submit.prevent="save" class="grid gap-6 m-6 md:grid-cols-2">

                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Project Name</label>
                        <input type="text" id="name" placeholder="Enter Project Name" v-model="project.p_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  required />
                    </div>
                    <div>
                        <label for="url" class="block mb-2 text-sm font-medium text-gray-900 ">Project Url</label>
                        <input type="text" id="url" placeholder="Enter Project url" v-model="project.url"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                    </div>
                    <div>
                        <label for="sdate" class="block mb-2 text-sm font-medium text-gray-900 ">Project Start Date</label>
                        <input datepicker datepicker-autohide datepicker-format="yyy-mm-dd"  type="text" v-model="project.start_date" id="sdate" placeholder="yyy-mm-dd" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                    </div>
                    <div>
                        <label for="edate" class="block mb-2 text-sm font-medium text-gray-900 ">Project End Date</label>
                        <input type="text" id="edate" datepicker datepicker-autohide datepicker-format="yyy-mm-dd" v-model="project.end_date" placeholder="yyy-mm-dd" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                    </div>
                    <button v-if="project.id==''" type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Save</button>
                    <button v-if="project.id!=''" type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto max-w-7xl mx-auto sm:px-6 lg:px-8 sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-black uppercase bg-gray-300 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                       ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Project Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Url
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Start Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        End Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Edit
                    </th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="p in result" v-bind:key="p.id" class="bg-white border-b ">
                    <td scope="col" class="px-5 py-4 font-large text-black whitespace-nowrap">{{ p.id }}</td>
                    <td scope="col" class="px-5 py-4 font-large text-black whitespace-nowrap">{{ p.p_name }}</td>
                    <td scope="col" class="px-5 py-4 font-large text-black whitespace-nowrap">{{ p.url }}</td>
                    <td scope="col" class="px-5 py-4 font-large text-black whitespace-nowrap">{{ p.start_date }}</td>
                    <td scope="col" class="px-5 py-4 font-large text-black whitespace-nowrap">{{ p.end_date }}</td>
                    <td scope="col" class="px-5 py-4 font-large text-black whitespace-nowrap">
                        <button type="button" class="focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2" @click="edit(p)">Edit</button>
                        <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2" @click="remove(p)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<script>
import axios from 'axios';

export default {
    name: 'Project',
    data () {
      return {
        result: {},
        project:{
                   id: '',
                   p_name: '',
                   url: '',
                   start_date: '',
                   end_date: ''


        }
      }
    },
    created() {
        this.ProjectLoad();
    },
    mounted() {
          console.log("mounted() called.......");
    },

    methods: {
           ProjectLoad()
           {
                 var page = "http://127.0.0.1:8000/api/project";
                 axios.get(page)
                  .then(
                      ({data})=>{
                        console.log(data);
                        this.result = data;
                      }
                  );
           },

           save()
           {
            console.log(this.project.id);
            if(this.project.id == '')
              {
                this.saveData();
              }
              else
              {
                this.updateData();
              }

           },
           saveData()
           {
            axios.post("http://127.0.0.1:8000/api/project", this.project)
            .then(
              ({data})=>{
                alert("saved");
                this.ProjectLoad();
                this.project.p_name = '';
                this.project.url = '';
                this.project.start_date = '';
                this.project.end_date = '';
                this.project.id = ''
              }
            )

           },
           edit(project)
           {
            this.project = project;
           },
           updateData()
           {
              var editrecords = 'http://127.0.0.1:8000/api/project/'+ this.project.id;
              axios.put(editrecords, this.project)
              .then(
                ({data})=>{
                    this.project.p_name = '';
                    this.project.url = '';
                    this.project.start_date = '';
                    this.project.end_date = '';
                    this.project.id = ''
                  alert("Updated!!!");
                  this.ProjectLoad();
                }
              );

           },

           remove(project){
              var url = `http://127.0.0.1:8000/api/project/${project.id}`;
              // var url = 'http://127.0.0.1:8000/api/project/'+ project.id;
              axios.delete(url);
              alert("Deleted");
              this.ProjectLoad();
            }
      }
  }
  </script>

