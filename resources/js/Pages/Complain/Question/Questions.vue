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
                    <div class="top-header d-flex justify-between items-center mb-3">
                        <h1 style="font-size: 20px; font-weight: bold;">Questions</h1>
                        <Link :href="`/admin/question/${id}/create`" type="button" class="btn btn-primary">Create Question</Link>
                    </div>
                    <div v-if="questions.length">
                        <div v-for="question in questions" :key="question.id" class="">
                            <Question :question="question"></Question>
                        </div>
                    </div>
                    <div v-else>
                        <div class="alert alert-danger">
                            <p>No Questions Found!</p>
                        </div>
                    </div>
                </div>
                <Link :href="`/admin/types`" type="button" class="btn btn-primary mt-3">Go Back</Link>
            </div>
        </div>
    </div>
</div>
</authenticated-layout>
</template>

<script setup>

import { Link } from '@inertiajs/vue3';
import Question from '@/Components/Question.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    questions: Object,
    id: String
})

</script>
