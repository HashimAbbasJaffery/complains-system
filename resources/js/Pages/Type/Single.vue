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
</style>

<template>
<authenticated-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="complain">
                        <div class="row">
                            <div class="type">CNIC:</div>
                            <div class="content">{{ complain.cnic }}</div>
                        </div>
                        <div class="row">
                            <div class="type">Membership Number:</div>
                            <div class="content">{{ complain.membership_number }}</div>
                        </div>
                        <div class="row">
                            <div class="type">Type:</div>
                            <div class="content">{{ complain.type.type }}</div>
                        </div>
                        <div class="row">
                            <div class="type">Complain:</div>
                            <div class="content">
                                {{ complain.complain }}
                            </div>
                        </div>
                    </div>
                    <Link href="/admin/complains" type="button" class="btn btn-primary mt-3">Go Back</Link>
                </div>
            </div>
        </div>
    </div>
</authenticated-layout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    complain: Array
});

console.log(props.complain);
</script>
