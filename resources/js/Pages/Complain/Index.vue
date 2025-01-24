<template>
<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Complains</h4>
                                <div class="table-responsive">
                                    <div class="input-group input-group-sm mb-3">
                                        <span>Search: </span>
                                        <input type="text" class="ml-2" style="height: 20px;">
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">CNIC</th>
                                                <th scope="col">Membership Number</th>
                                                <th scope="col">Complain Type</th>
                                                <th scope="col">Action</th>
                                           
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="complain in complains.data" :key="complain.id" :style="{'background-color': complain.highlighted ? '#f5f5f5' : ''}">
                                                <td>{{ complain.cnic }}</td>
                                                <td>{{ complain.membership_number }}</td>
                                                <td>{{ complain.type.type }}</td>
                                                <td>
                                                    <Link :href="`/admin/complain/${complain.id}/highlight`" method="PUT" type="button" class="btn btn-primary">Highlight</Link>
                                                    <Link :href="`/admin/complains/${complain.id}`" type="button" class="btn btn-secondary ml-2">View</Link>
                                                    <Link method="DELETE" :href="`/admin/complains/${complain.id}`" class="btn btn-danger ml-2">Delete</Link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <Link :href="link.url" :style="{ 'background-color': !link.active ? '#f5f5f5' : '' }" class="page-item" v-for="link in complains.links"><a class="page-link" href="#" v-html="link.label"></a></Link>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
</template>

<script setup>

import { Link } from '@inertiajs/vue3';

const props = defineProps({
    complains: Array
});

console.log(props.complains.links);

</script>
