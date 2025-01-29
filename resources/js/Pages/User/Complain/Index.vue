<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap');

.type {
    transition: 0.5s;
}

.type:hover {
    transform: scale(1.04);
    border: 1px solid green;
    background-color: rgb(233, 233, 233);
}

@media (max-width: 768px) {
    .logo {
        display: flex;
        flex-direction: column;
    }
    .type {
        width: 100% !important;
    }
    .step {
        width: 70% !important;
    }
}
* {
    font-family: "Lato", serif;
}

/* Step transitions */
.step-transition-leave-active {
    transition: all 0s ease;
}
.step-transition-enter-active {
    transition: all 0.5s ease;
}

.step-transition-enter-from {
    opacity: 0;
    transform: translateX(-50px);
}
.step-transition-enter-to {
    opacity: 1;
    transform: translateX(0);
}
.step-transition-leave-from {
    opacity: 1;
    transform: translateX(0);
}
.step-transition-leave-to {
    opacity: 0;
    transform: translateX(50px);
}
</style>

<template>
    <header class="d-flex justify-content-center py-3">
        <div class="logo d-flex align-items-center mb-5 justify-between" style="width: 60%; margin: 0 auto; background: white;">
            <img src="https://gwadargymkhana.com.pk/complains/public/assets/images/black_logo.png" width="100" alt="">
            <h1 style="font-size: 20px; font-weight: 500;">Complain Form</h1>
        </div>
    </header>
    <div class="d-flex justify-content-center flex-column steps-container">
        <Transition name="step-transition">
            <div v-if="current_step === 1" class="step step-1 mt-5" style="width: 60%; margin: 0 auto;">
                <div class="form-group">
                    <label for="cnic">CNIC</label>
                    <div class="text-danger mb-2" v-if="errors.cnic.length">CNIC is required</div>
                    <input type="text" id="cnic" v-model="cnic" class="form-control" :class="{ 'border border-danger': errors.cnic.length }" placeholder="Enter CNIC">
                </div>
                <div class="form-group">
                    <label for="membership_no">Membership Number</label>
                    <div class="text-danger mb-2" v-if="errors.membership_number.length">Membership Number is required</div>
                    <input type="text" v-model="membership_number" :class="{ 'border border-danger': errors.membership_number.length }" class="form-control" id="membership_no" placeholder="Membership Number">
                </div>
                <div class="form-group">
                    <label for="membership_no">Member Name</label>
                    <div class="text-danger mb-2" v-if="errors.members_name.length">No Member Found!, make sure you write correct cnic and membership number</div>
                    <input type="text" v-model="member_name" :class="{ 'border border-danger': errors.members_name.length }" class="form-control" id="membership_no" placeholder="Member Name" readonly>
                </div>
            </div>
        </Transition>

        <Transition name="step-transition">
            <div class="step step-2 d-flex" v-if="current_step === 2" style="width: 60%; margin: 0 auto;">
                <div style="width: 100%;">
                    <h1 style="font-size: 20px; color: black;" class="mb-2">Complain Type</h1>
                    <div class="types d-flex gap-2 flex-wrap" >
                        <div :key="type.id" v-for="type in types" @click="selectType(type.id)" class="type border border-dark p-2 rounded-md mb-1 text-center" style="width: 32.33%; cursor: pointer; color: black;">
                            {{ type.type }}
                        </div>
                    </div>
                </div>
            </div>
        </Transition>

        <Transition name="step-transition">
            <div class="step step-3" v-if="current_step === 3" style="width: 60%; margin: 0 auto;">
                <h1 style="font-size: 20px;" class="mb-2">Questions</h1>
                <div class="questions d-flex justify-content-between flex-wrap" >
                    <div :key="question.id" @click="finalStep(question.id, question.is_relevant)" v-for="question in questions.filter(question => question.complain_type_id == complain_type_id)" class="question border border-dark py-2 px-3 rounded-md mb-3 d-flex justify-between align-items-center" style="width: 100%; cursor: pointer; color: black">
                        {{ question.question }}
                    </div>
                </div>
            </div>
        </Transition>

        <Transition name="step-transition">
            <div class="step-4" v-if="current_step === 4 && !is_relevant" style="width: 60%; margin: 0 auto;">
                <h1 style="font-size: 20px; font-weight: 500;" class="mb-3">{{ questions.filter(quest => quest.id == question_id)[0].question }}</h1>
                <p v-html="convertNewlines(questions.filter(quest => quest.id == question_id)[0].answer)">
                </p>
            </div>
        </Transition>

        <Transition name="step-transition">
            <div class="step step-4" v-if="current_step === 4 && !completed && is_relevant" style="width: 60%; margin: 0 auto;">
                <div class="mb-3">
                    <label for="complain" class="form-label">Write Complain</label>
                    <textarea class="form-control rounded-md" style="border: 1px solid black; height: 200px; resize: none" v-model="complain" id="complain" rows="3"></textarea>
                </div>
            </div>
        </Transition>

        <Transition name="step-transition">
            <div class="thank-you text-center" v-if="completed" style="width: 60%; margin: 0 auto;">
                <DotLottieVue
                    src="https://lottie.host/89f240ca-38d3-4ac5-9baf-ca33726e69cb/yBUZqRgh9W.lottie"
                    background="transparent"
                    speed="1"
                    style="width: 180px; height: 180px; margin: 0 auto;"
                    autoplay
                ></DotLottieVue>
                <p style="font-size: 20px;">We have received your complain. We will try to respond as soon as possible</p>
            </div>
        </Transition>

        <div class="actions d-flex gap-2 mt-3" style="width: 60%; margin: 0 auto;" v-if="!completed">
            <button type="button" v-if="current_step > 1" @click="current_step--" style="width: 100%" class="btn btn-info">Previous</button>
            <button type="button" @click="nextStep" v-if="current_step <= 1" style="width: 100%" class="btn btn-info">Next</button>
            <button type="button" @click="submit" v-if="current_step === 4 && submission_allowed && is_relevant" style="width: 100%" class="btn btn-info">Submit</button>
        </div>
        <div class="steps mx-auto mt-3 d-flex gap-1 align-items-center" v-if="!completed">
            <div class="step" :style="{ 'background': current_step === 1 ? 'blue' : 'gray', 'width': current_step === 1 ? '6px' : '5px', 'height': current_step === 1 ? '6px' : '5px' }" style="border-radius: 50px;">&nbsp;</div>
            <div class="step" :style="{ 'background': current_step === 2 ? 'blue' : 'gray', 'width': current_step === 2 ? '6px' : '5px', 'height': current_step === 2 ? '6px' : '5px' }" style="border-radius: 50px;">&nbsp;</div>
            <div class="step" :style="{ 'background': current_step === 3 ? 'blue' : 'gray', 'width': current_step === 3 ? '6px' : '5px', 'height': current_step === 3 ? '6px' : '5px' }" style="border-radius: 50px;">&nbsp;</div>
            <div class="step" :style="{ 'background': current_step === 4 ? 'blue' : 'gray', 'width': current_step === 4 ? '6px' : '5px', 'height': current_step === 4 ? '6px' : '5px' }" style="border-radius: 50px;">&nbsp;</div>
        </div>
    </div>
</template>
<script setup>

import { ref, Transition, watch, watchEffect, reactive, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import { DotLottieVue } from '@lottiefiles/dotlottie-vue';


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
const errors = reactive({
    cnic: "",
    membership_number: "",
    members_name: ""
});
const loading = ref(false);

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
    errors.cnic = "";
    errors.members_name = "";
    errors.membership_number = "";
    if(!cnic.value) {
        errors.cnic = "CNIC is required"
    }
    if(!membership_number.value) {
        errors.membership_number = "Membership Number is required"
    }
    if(!cnic.value || !membership_number.value) return;
    if(!member_name.value) {
        errors.members_name = "Please Enter correct CNIC and membership number";
        return;
    }
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
    router.post(route('complain.submit'), { ...payload }, { preserveScroll: true })
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
        const status = await axios.get(route('members'), { params: {cnic: cnic.value, membership_no: membership_number.value} });
        member_name.value = status.data.members_name;
    }
    loading.value = false;
})

const convertNewlines = (str) => {
    return str.replace(/\n/g, "<br>");
}


</script>
