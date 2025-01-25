<style scoped>
.type {
    flex: 0 0 20%; /* Fixed width of 20%, does not grow or shrink */
    font-weight: bold; /* Optional for better styling */
}
.content {
    flex: 1; /* Takes up the remaining space */
    word-wrap: break-word; /* Ensures long text wraps */
}
.row {
    display: flex;
    align-items: center; /* Vertically center items */
    margin-bottom: 10px; /* Add spacing between rows */
    border: 1px solid #e5e7eb;
    border-bottom: 0px;
    margin: 0px;
    padding: 10px 10px;
}
.complain:last-child {
    border-bottom: 1px solid #e5e7eb;
}
input {
    border: 1px solid #e9ecef;
}
</style>

<template>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                <h1 style="font-size: 20px; font-weight: bold;" class="mb-3">Update User</h1>
                <div class="complain">
              
                    <div class="form-group">
                        <label for="example-email">Username</label>
                        <div v-if="$page.props?.errors?.name" class="text-danger mb-1">{{ $page.props?.errors?.name }}</div>
                        <input type="text" v-model="form.name" name="name" class="form-control" :class="{ 'border-danger': $page.props?.errors?.name }" placeholder="Username">
                    </div>
                </div>
                <div class="complain">
                    <div class="form-group">
                        <label for="example-email">Password</label>
                        <div v-if="$page.props?.errors?.password" class="text-danger mb-1">{{ $page.props?.errors?.password }}</div>
                       
                        <input type="password" v-model="form.password" name="password" class="form-control" :class="{ 'border-danger': $page.props?.errors?.password }" placeholder="Password">
                    </div>
                </div>
                <div class="complain">
                    <div class="form-group">
                        <label for="example-email">Fullname</label>
                        <div v-if="$page.props?.errors?.fullname" class="text-danger mb-1">{{ $page.props?.errors?.fullname }}</div>
                        <input type="text" v-model="form.fullname" name="fullname" class="form-control" :class="{ 'border-danger': $page.props?.errors?.fullname }" placeholder="Fullname">
                    </div>
                </div>
                <div class="complain">
                    <div class="form-group">
                        <label for="example-email">Role</label>
                        
                        <div v-if="$page.props?.errors?.admin" class="text-danger mb-1">{{ $page.props?.errors?.admin }}</div>
                        <select class="form-control" :class="{ 'border-danger': $page.props?.errors?.admin }" v-model="form.admin" name="admin">
                            <option value="1" selected>Admin</option>
                            <option value="0">User</option>
                        </select>
                    </div>
                </div>
                <Link @click="create" type="button" class="btn btn-primary mt-3">Create</Link>
                <Link href="/admin/users" type="button" class="btn btn-secondary mt-3 ml-2">Cancel</Link>
            </div>
        </div>
    </div>
</div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    user: Object
})

const form = reactive({
    name: props.user.name,
    password: "",
    fullname: props.user.fullname,
    admin: props.user.admin
});

const create = () => {
    router.post("/admin/users", { ...form });
}



</script>
