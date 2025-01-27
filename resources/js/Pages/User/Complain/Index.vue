<style scoped>

.type {
    transition: .5s;
}

.type:hover {
    transform: scale(1.04);
    border: 1px solid green;
}

@media (max-width: 768px) {
  .logo {
    flex-direction: column; 
  }
  .type {
    width: 100% !important;
  }
  .step {
    width: 70% !important;
  }
}

</style>
<template>
    <header class="d-flex justify-content-center">
        <div class="logo d-flex align-items-center justify-between" style="width: 60%; margin: 0 auto; position: fixed; top: 0px; background: white;">
            <img src="/assets/images/black_logo.png" width="100" alt="">
            <h1 style="font-size: 20px; font-weight: 500;">Complain Form</h1>
        </div>
    </header>
    <div class="d-flex justify-content-center flex-column steps-container" style="height: 50vh; margin-top: 150px;">
        <div v-if="current_step === 1" class="step step-1 mt-5" style="width: 60%; margin: 0 auto;">
            <div class="form-group">
                <label for="cnic">CNIC</label>
                <input type="text" id="cnic" v-model="cnic" class="form-control" placeholder="Enter CNIC">
            </div>
            <div class="form-group">
                <label for="membership_no">Membership Number</label>
                <input type="text" v-model="membership_number" class="form-control" id="membership_no" placeholder="Membership Number">
            </div>
            <div class="form-group">
                <label for="membership_no">Member Name</label>
                <input type="text" v-model="member_name" class="form-control" id="membership_no" placeholder="Member Name" readonly>
            </div>
        </div>

        <div class="step step-2" v-if="current_step === 2" style="width: 60%; margin: 0 auto;">
            <h1 style="font-size: 20px;" class="mb-2">Complain Type</h1>
            <div class="types d-flex gap-2 flex-wrap" >
                <div v-for="type in types" @click="selectType(type.id)" class="type border border-dark p-2 rounded-md mb-1 text-center" style="width: 32.33%; cursor: pointer;">
                    {{ type.type }}
                </div>
            </div>
        </div>

        <div class="step step-3" v-if="current_step === 3" style="width: 60%; margin: 0 auto;">
            <h1 style="font-size: 20px;" class="mb-2">Questions</h1>
            <div class="questions d-flex justify-content-between flex-wrap" >
                <div @click="finalStep(question.id, question.is_relevant)" v-for="question in questions.filter(question => question.complain_type_id == complain_type_id)" class="question border border-dark py-2 px-3 rounded-md mb-3 d-flex justify-between align-items-center" style="width: 100%; cursor: pointer;">
                    {{ question.question }}
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </div>
        <div class="step-4" v-if="current_step === 4 && !is_relevant" style="width: 60%; margin: 0 auto;">
            <h1 style="font-size: 20px; font-weight: 500;" class="mb-3">{{ questions.filter(quest => quest.id == question_id)[0].question }}</h1>
            <p v-html="convertNewlines(questions.filter(quest => quest.id == question_id)[0].answer)">
            </p>
        </div>
        <div class="step step-4" v-if="current_step === 4 && !completed && is_relevant" style="width: 60%; margin: 0 auto;">
            <div class="mb-3">
                <label for="complain" class="form-label">Write Complain</label>
                <textarea class="form-control rounded-md" style="border: 1px solid black; height: 200px; resize: none" v-model="complain" id="complain" rows="3"></textarea>
            </div>
        </div>

        <div class="thank-you text-center" v-if="completed" style="width: 60%; margin: 0 auto;">
            <h1 style="font-size: 20px; font-weight: 500;">Thank You!</h1>
            <p>We have saved your complain. we will try to respond you as soon as possible.</p>
        </div>

        <div class="actions d-flex gap-2 mt-3" style="width: 60%; margin: 0 auto;" v-if="!completed">
            <button type="button" v-if="current_step > 1" @click="current_step--" style="width: 100%" class="btn btn-info">Previous</button>
            <button type="button" @click="nextStep" v-if="current_step <= 1" style="width: 100%" class="btn btn-info">Next</button>
            <button type="button" @click="submit" v-if="current_step === 4 && submission_allowed && is_relevant" style="width: 100%" class="btn btn-info">Submit</button>
        </div>
        <div class="steps mx-auto mt-3 d-flex gap-1" v-if="!completed">
            <div class="step" :style="{ 'background': current_step === 1 ? 'blue' : 'gray', 'width': current_step === 1 ? '6px' : '5px', 'height': current_step === 1 ? '6px' : '5px' }" style="border-radius: 50px;">&nbsp;</div>
            <div class="step" :style="{ 'background': current_step === 2 ? 'blue' : 'gray', 'width': current_step === 2 ? '6px' : '5px', 'height': current_step === 2 ? '6px' : '5px' }" style="border-radius: 50px;">&nbsp;</div>
            <div class="step" :style="{ 'background': current_step === 3 ? 'blue' : 'gray', 'width': current_step === 3 ? '6px' : '5px', 'height': current_step === 3 ? '6px' : '5px' }" style="border-radius: 50px;">&nbsp;</div>
            <div class="step" :style="{ 'background': current_step === 4 ? 'blue' : 'gray', 'width': current_step === 4 ? '6px' : '5px', 'height': current_step === 4 ? '6px' : '5px' }" style="border-radius: 50px;">&nbsp;</div>
        </div>
    </div>
</template>
<script setup>

import { ref, watch, watchEffect } from 'vue';
import { router } from '@inertiajs/vue3';

const current_step = ref(1);
const submission_allowed = ref(true);
const completed = ref(false);

const cnic = ref("");
const membership_number = ref("");
const complain_type_id = ref();
const question_id = ref();
const complain = ref("");
const is_relevant = ref(false);
const member_name = ref("");

const props = defineProps({
    types: Array,
    questions: Array
});

const selectType = id => {
    current_step.value++;
    complain_type_id.value = id;
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Smooth scroll animation
    });
}

const nextStep = () => {
    if(!cnic.value || !membership_number.value) return;
    if(!member_name.value) return;
    current_step.value++;
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Smooth scroll animation
    });
}

const finalStep = (id, relevant) => {
    current_step.value++;
    question_id.value = id;
    is_relevant.value = relevant
}

const submit = () => {
    if(!complain.value.length) return;
    completed.value = true;
    const payload = {
        complain: complain.value,
        cnic: cnic.value,
        membership_number: membership_number.value,
        type_id: complain_type_id.value,
        question_id: question_id.value
    };
    router.post("/complain", { ...payload }, { preserveScroll: true })
}

watch(cnic, function(newValue) {
    // Remove any existing non-numeric characters to avoid unwanted behavior
    let formattedCnic = newValue.replace(/\D/g, '');

    // Add hyphens at the appropriate positions
    if (formattedCnic.length > 5) {
        formattedCnic = `${formattedCnic.slice(0, 5)}-${formattedCnic.slice(5)}`;
    }
    if (formattedCnic.length > 13) {
        formattedCnic = `${formattedCnic.slice(0, 13)}-${formattedCnic.slice(13)}`;
    }

    // Update the CNIC value only if it's different from the current formatted CNIC
    if (formattedCnic !== newValue) {
        cnic.value = formattedCnic;
    }
});

watchEffect(async function() {
    if(cnic.value && membership_number.value) {
        const status = await axios.get("/members", { params: {cnic: cnic.value, membership_no: membership_number.value} });
        member_name.value = status.data.members_name;
    }
})

const convertNewlines = (str) => {
    return str.replace(/\n/g, "<br>");
}


</script>
