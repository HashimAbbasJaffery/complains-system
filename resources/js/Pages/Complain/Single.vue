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
}
</style>

<template>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="complain">
                    <div class="row">
                        <div class="type">CNIC:</div>
                        <div class="content">836483782</div>
                    </div>
                    <div class="row">
                        <div class="type">Membership Number:</div>
                        <div class="content">501</div>
                    </div>
                    <div class="row">
                        <div class="type">Type:</div>
                        <div class="content">Reciprocal Issue</div>
                    </div>
                    <div class="row">
                        <div class="type">Complain:</div>
                        <div class="content">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    complain: Array
});

console.log(props.complain);
</script>
