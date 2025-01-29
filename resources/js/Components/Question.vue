<style scoped>

input, select {
    border: 1px solid #e9ecef;
    font-size: .875rem;
}

</style>
<template>
    <div class="question d-flex align-items-center gap-4 border border-dark rounded-md p-2 d-flex justify-between mb-3">
        <div class="question-content d-flex align-items-start gap-2">
            <div>
                <p>{{ question.question }}</p>  
            </div>
            <span class="badge badge-primary">{{ question.is_relevant ? "Relevant" : "Irrelevant" }}</span>
        </div>
        <div class="right-side-items d-flex gap-2">
            <button type="button" class="btn btn-primary" @click="is_hidden = !is_hidden">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
            <button type="button" v-if="$page.props?.auth?.user?.admin" @click="deleteModal" class="btn btn-danger">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
    </div>
    <div class="mt-3" v-if="!is_hidden">
        <div class="form-group d-flex gap-2">
            <input type="text" v-model="form.question" name="question" class="form-control" style="height: 33px; width: 50%;" placeholder="Question">
            <select name="is_relevant" v-model="form.is_relevant" style="width: 50%; height: 33px; padding: 0px 5px 0px 5px;">
                <option value="1">Relevant</option>
                <option value="0">Irrelevant</option>
            </select>
        </div>
        <div class="form-group d-flex gap-2" v-if="form.is_relevant == 0">
            <textarea name="answer" class="form-control" placeholder="Answer" v-model="form.answer"></textarea>
        </div>
        
        <button type="button" class="btn btn-primary mb-3" @click="update">Update</button>
    </div>
</template>
<script setup>

import { reactive, ref } from "vue";
import { router } from "@inertiajs/vue3";

const is_hidden = ref(true);


const props = defineProps({
    question: Object
});

const form = reactive({
    id: props.question.id,
    question: props.question.question,
    is_relevant: props.question.is_relevant,
    answer: props.question.answer
})

const deleteModal = () => {
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
            router.delete(route('questions.destroy', { question: form.id }), { preserveScroll: true })
        }
    })
}

const update = () => {
    router.put(route('questions.update', { question: form.id }), { ...form });
    is_hidden.value = true;
}



</script>