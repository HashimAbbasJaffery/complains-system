<template>
<authenticated-layout>
<div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h1 style="font-size: 20px; font-weight: bold;" class="mb-3">Users</h1>
                                <div class="table-responsive">
                                    <div class="dates d-flex justify-start gap-4">
                                        <div class="mb-3">
                                            <span>From: </span>
                                            <input type="date" id="from" class="ml-2" v-model="filterParameters.from" style="height: 34px;">
                                        </div>

                                        <div class="mb-3">
                                            <span>To: </span>
                                            <input type="date" id="to" class="ml-2" v-model="filterParameters.to" style="height: 34px;">
                                        </div>
                                        <div >
                                            <button type="button" @click="filter" class="btn btn-primary">
                                                <i class="fa-solid fa-filter"></i>
                                            </button>

                                            <button type="button" @click="reset" class="btn btn-secondary ml-2">
                                                <i class="fa-solid fa-arrows-rotate"></i>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="mb-3 d-flex justify-between">
                                        <div class="search">
                                            <span>Search: </span>
                                            <input type="text" id="search" @input="sendRequest" class="ml-2 rounded" v-model="filterParameters.keyword" style="height: 34px;">
                                        </div>
                                        <Link :href="route('admin.users.create')" method="GET" type="button" class="btn btn-info">Create User</Link>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Username</th>
                                                <th scope="col">Full name</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="user in users.data" :key="user.id">
                                                <td>{{ user.name }}</td>
                                                <td>{{ user.fullname }}</td>
                                                <td>{{ user.role ? "Admin" : "User" }}</td>
                                                <td>
                                                    <Link :href="route('admin.users.edit', { user: user.id })" type="button" class="btn btn-primary" preserve-scroll>
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </Link>
                                                    <button @click="deleteModal(user.id)" class="btn btn-danger ml-2" preserve-scroll v-if="$page.props?.auth?.user?.admin">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <Link :href="link.url" class="page-item" v-for="link in users.links" :key="link.label"><a class="page-link" :style="{ 'background-color': link.active ? '#f5f5f5' : '' }" href="#" v-html="link.label"></a></Link>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
</div>
</authenticated-layout>
</template>

<script setup>
import { onMounted, reactive } from 'vue';
import { Link, router } from '@inertiajs/vue3'
import debounce from 'lodash/debounce';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const url = new URL(window.location.href);
const queryParams = new URLSearchParams(url.search);

// Populate reactive object with query parameters when the page is refreshed
const filterParameters = reactive({
    keyword: queryParams.get("keyword") || "",  // Make sure to default to empty string if no keyword in URL
    from: queryParams.get("from") || "",
    to: queryParams.get("to") || ""
});

const props = defineProps({
    users: Array
});

// Debounced function to send request after typing
const sendRequest = debounce(() => {
    router.get(route('admin.users.index'), { ...filterParameters }, { preserveScroll: true });
}, 500);

const filter = () => {
    // Trigger the filter with updated parameters
    router.get(route("admin.users.index"), { ...filterParameters }, { preserveScroll: true });
};

const reset = () => {
    // Reset the filter parameters
    filterParameters.keyword = "";
    filterParameters.from = "";
    filterParameters.to = "";
    // Trigger the filter with updated parameters
    router.get(route("admin.users.index"), { ...filterParameters }, { preserveScroll: true });
};

onMounted(() => {
    // Focus on search input field if keyword is pre-populated
    if (filterParameters.keyword.length > 0) {
        document.getElementById('search').focus();
    }
});

const update = (type, id) => {
    Swal.fire({
  title: "Update Type",
  input: "text",
  inputValue: type,
  inputAttributes: {
    autocapitalize: "off"
  },
  showCancelButton: true,
  confirmButtonText: "Look up",
  showLoaderOnConfirm: true,
  preConfirm: async (login) => {

  },
  allowOutsideClick: () => !Swal.isLoading()
}).then((result) => {
  if (result.isConfirmed) {
    router.put(`/admin/users/${id}`, { type: result.value }, { preserveScroll: true });
  }
});
}

const deleteModal = id=> {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('admin.users.destroy', { user: id }), { preserveScroll: true });
        }
    })
}

const create = () => {
    Swal.fire({
        title: 'Create Type',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Create',
        showLoaderOnConfirm: true,
        preConfirm: async (type) => {
            router.post('/admin/users', { type }, { preserveScroll: true });
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
}


</script>
