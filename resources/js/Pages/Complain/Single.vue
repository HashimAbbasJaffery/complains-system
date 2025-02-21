<style scoped>

</style>

<template>
<authenticated-layout>
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <h1 style="font-size: 20px; font-weight: bold;" class="mb-3">View Complain</h1>
                    <div class="complain">
                        <div class="complain-row">
                            <div class="type">CNIC:</div>
                            <div class="content">{{ complain.cnic }}</div>
                        </div>
                        <div class="complain-row">
                            <div class="type">Membership Number:</div>
                            <div class="content">{{ complain.membership_number }}</div>
                        </div>
                        <div class="complain-row">
                            <div class="type">Type:</div>
                            <div class="content">{{ complain.type.type }}</div>
                        </div>
                        <div class="complain-row">
                            <div class="type">Question:</div>
                            <div class="content">{{ complain.question.question }}</div>
                        </div>
                        <div class="complain-row" style="border-bottom: 1px solid #e5e7eb !important;">
                            <div class="type">Complain:</div>
                            <div class="content" v-html="convertNewlines(complain.complain)">
                            </div>
                        </div>
                    </div>
                    <Link :href="route('admin.complains.index')" type="button" class="btn btn-primary mt-3">Go Back</Link>
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

const convertNewlines = (str) => {
    return str.replace(/\n/g, "<br>");
}
</script>
