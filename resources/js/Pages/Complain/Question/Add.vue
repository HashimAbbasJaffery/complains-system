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
<authenticated-layout>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="complain">

                    <div class="form-group">
                        <label for="example-email">Question</label>
                        <div v-if="$page.props?.errors?.name" class="text-danger mb-1">{{ $page.props?.errors?.name }}</div>
                        <input type="text" v-model="form.question" name="name" class="form-control" :class="{ 'border-danger': $page.props?.errors?.name }" placeholder="Question">
                    </div>
                </div>

                <div class="complain">
                    <div class="form-group">
                        <label for="example-email">Is Relevant</label>

                        <div v-if="$page.props?.errors?.admin" class="text-danger mb-1">{{ $page.props?.errors?.admin }}</div>
                        <select class="form-control" :class="{ 'border-danger': $page.props?.errors?.admin }" v-model="form.is_relevant" name="admin">
                            <option value="1" selected>Relevant</option>
                            <option value="0">Irrelevant</option>
                        </select>
                    </div>
                </div>
                <div class="complain">
                    <div class="form-group" v-if="form.is_relevant == 0">
                        <label for="example-email">Answer</label>
                        <div v-if="$page.props?.errors?.answer" class="text-danger mb-1">{{ $page.props?.errors?.answer }}</div>
                        <textarea type="password" v-model="form.answer" name="password" class="form-control" :class="{ 'border-danger': $page.props?.errors?.password }" placeholder="Answer here"></textarea>
                    </div>
                </div>
                <Link @click="create" type="button" class="btn btn-primary mt-3">Create</Link>
                <Link :href="`/admin/${id}/questions`" type="button" class="btn btn-secondary mt-3 ml-2">Cancel</Link>
            </div>
        </div>
    </div>
</div>
</authenticated-layout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = reactive({
    question: "",
    is_relevant: 1,
    answer: ""
});

const props = defineProps({
    id: String
})

const create = () => {
    router.post(`/admin/question/${props.id}/create`, { ...form });
}



</script>
