<style scoped>

.type {
    transition: .5s;
}

.type:hover {
    transform: scale(1.04);
    border: 1px solid green;
}

</style>
<template>
    <header class="d-flex justify-content-center">
        <div class="logo d-flex align-items-center justify-between" style="width: 60%; margin: 0 auto; position: fixed; top: 0px; ">
            <img src="/assets/images/black_logo.png" width="100" alt="">
            <h1 style="font-size: 20px; font-weight: 500;">Complain Form</h1>
        </div>
    </header>
    <div class="d-flex justify-content-center flex-column" style="height: 100vh;">
        <div v-if="current_step === 1" class="step-1 mt-5" style="width: 60%; margin: 0 auto;">
            <div class="form-group">
                <label for="cnic">CNIC</label>
                <input type="text" id="cnic" class="form-control" placeholder="Enter CNIC">
            </div>
            <div class="form-group">
                <label for="membership_no">Membership Number</label>
                <input type="password" class="form-control" id="membership_no" placeholder="Password">
            </div>
        </div>

        <div class="step-2" v-if="current_step === 2" style="width: 60%; margin: 0 auto;">
            <h1 style="font-size: 20px;" class="mb-2">Complain Type</h1>
            <div class="types d-flex justify-content-between flex-wrap" >
                <div @click="current_step++" class="type border border-dark p-2 rounded-md mb-3 text-center" style="width: 32.33%; cursor: pointer;">
                    Reciprocal Issues
                </div>
                <div @click="current_step++" class="type border border-dark p-2 rounded-md mb-3 text-center" style="width: 32.33%; cursor: pointer;">
                    Reciprocal Issues
                </div>
                <div @click="current_step++" class="type border border-dark p-2 rounded-md mb-3 text-center" style="width: 32.33%; cursor: pointer;">
                    Reciprocal Issues
                </div>
                <div @click="current_step++" class="type border border-dark p-2 rounded-md mb-3 text-center" style="width: 32.33%; cursor: pointer;">
                    Reciprocal Issues
                </div>
                <div @click="current_step++" class="type border border-dark p-2 rounded-md mb-3 text-center" style="width: 32.33%; cursor: pointer;">
                    Reciprocal Issues
                </div>
                <div @click="current_step++" class="type border border-dark p-2 rounded-md mb-3 text-center" style="width: 32.33%; cursor: pointer;">
                    Reciprocal Issues
                </div>
            </div>
        </div>

        <div class="step-3" v-if="current_step === 3" style="width: 60%; margin: 0 auto;">
            <h1 style="font-size: 20px;" class="mb-2">Questions</h1>
            <div class="questions d-flex justify-content-between flex-wrap" >
                <div @click="current_step++" class="question border border-dark py-2 px-3 rounded-md mb-3 d-flex justify-between align-items-center" style="width: 100%; cursor: pointer;">
                    Why XYZ person is not getting perks?
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
                <div @click="current_step++" class="question border border-dark py-2 px-3 rounded-md mb-3 d-flex justify-between align-items-center" style="width: 100%; cursor: pointer;">
                    Why XYZ person is not getting perks?
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
                <div @click="current_step++" class="question border border-dark py-2 px-3 rounded-md mb-3 d-flex justify-between align-items-center" style="width: 100%; cursor: pointer;">
                    Why XYZ person is not getting perks?
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
                <div @click="current_step++" class="question border border-dark py-2 px-3 rounded-md mb-3 d-flex justify-between align-items-center" style="width: 100%; cursor: pointer;">
                    Why XYZ person is not getting perks?
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
                <div @click="current_step++" class="question border border-dark py-2 px-3 rounded-md mb-3 d-flex justify-between align-items-center" style="width: 100%; cursor: pointer;">
                    Why XYZ person is not getting perks?
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
                <div @click="current_step++" class="question border border-dark py-2 px-3 rounded-md mb-3 d-flex justify-between align-items-center" style="width: 100%; cursor: pointer;">
                    Why XYZ person is not getting perks?
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="step-4" v-if="current_step === 5" style="width: 60%; margin: 0 auto;">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos officiis cupiditate est repellendus ab dicta accusamus dolorem id reprehenderit quas, commodi libero, distinctio doloremque porro eligendi alias inventore cumque quaerat laborum eius! Repellat tenetur unde pariatur molestiae atque. Reiciendis libero beatae quia, iure, odio accusamus delectus magnam, sapiente quo consectetur deserunt reprehenderit temporibus dignissimos aliquam. Cum eveniet quas tempore eaque molestiae alias a neque quo soluta aliquid, nisi quibusdam consectetur ex magni fuga minus iure temporibus omnis quaerat expedita! Aperiam, natus, hic architecto dignissimos a asperiores deserunt impedit aspernatur, dolorum nulla nihil! Earum eum sunt, est sit labore laborum recusandae?
            </p>
        </div>

        <div class="step-4" v-if="current_step === 4 && !completed" style="width: 60%; margin: 0 auto;">
            <div class="mb-3">
                <label for="complain" class="form-label">Write Complain</label>
                <textarea class="form-control" id="complain" rows="3"></textarea>
            </div>
        </div>

        <div class="thank-you text-center" v-if="completed" style="width: 60%; margin: 0 auto;">
            <h1 style="font-size: 20px; font-weight: 500;">Thank You!</h1>
            <p>We have saved your complain. we will try to respond you as soon as possible.</p>
        </div>

        <div class="actions d-flex gap-2 mt-3" style="width: 60%; margin: 0 auto;" v-if="!completed">
            <button type="button" v-if="current_step > 1" @click="current_step--" style="width: 100%" class="btn btn-info">Previous</button>
            <button type="button" @click="current_step++" v-if="current_step <= 1" style="width: 100%" class="btn btn-info">Next</button>
            <button type="button" v-if="current_step === 4 && submission_allowed" style="width: 100%" class="btn btn-info" @click="completed = true;">Submit</button>
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

import { ref } from 'vue';

const current_step = ref(1);
const submission_allowed = ref(true);
const completed = ref(false);

</script>
