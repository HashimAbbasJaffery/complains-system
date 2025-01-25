<template>
<div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
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
                                            <button type="button" @click="filter" class="btn btn-primary">Filter</button>

                                            <button type="button" @click="reset" class="btn btn-secondary ml-2">Reset</button>
                                        </div>

                                    </div>
                                    <div class="mb-3 d-flex justify-between">
                                        <div class="search">
                                            <span>Search: </span>
                                            <input type="text" id="search" @input="sendRequest" class="ml-2 rounded" v-model="filterParameters.keyword" style="height: 34px;">
                                        </div>
                                        <Link href="/admin/users/create" method="GET" type="button" class="btn btn-info">Create User</Link>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Username</th>
                                                <th scope="col">Email</th>
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
                                                    <Link :href="`/admin/users/${user.id}/edit`" type="button" class="btn btn-primary" preserve-scroll>Update</Link>
                                                    <button @click="deleteModal(user.id)" class="btn btn-danger ml-2" preserve-scroll v-if="$page.props?.auth?.user?.admin">Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <Link :href="link.url" :style="{ 'background-color': !link.active ? '#f5f5f5' : '' }" class="page-item" v-for="link in users.links" :key="link.label"><a class="page-link" href="#" v-html="link.label"></a></Link>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
</template>

<script setup>
import { onMounted, reactive } from 'vue';
import { Link, router } from '@inertiajs/vue3'
import debounce from 'lodash/debounce';

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
    router.get("/admin/users", { ...filterParameters }, { preserveScroll: true });
}, 500);

const filter = () => {
    // Trigger the filter with updated parameters
    router.get("/admin/users", { ...filterParameters }, { preserveScroll: true });
};

const reset = () => {
    // Reset the filter parameters
    filterParameters.keyword = "";
    filterParameters.from = "";
    filterParameters.to = "";
    // Trigger the filter with updated parameters
    router.get("/admin/users", { ...filterParameters }, { preserveScroll: true });
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
            router.delete(`/admin/users/${id}`, { preserveScroll: true });
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
