<script setup>

import { Link } from '@inertiajs/vue3';

</script>

<style>
    input {
        border: 1px solid #e5e7eb !important;
    }
</style>

<template>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">

        <aside class="left-sidebar" style="padding-top: 0px;" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar d-flex flex-col justify-content-between">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <img src="/assets/images/card_logo.png" alt="homepage" class="dark-logo" />
                        <li class="sidebar-item">
                            <Link href="/admin/complains"  :class="{ 'active': ['Complain/Index', 'Complain/Single'].includes($page.component) }" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="true">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <span class="hide-menu">Complains</span>
                            </Link>
                        </li>
                        <li class="sidebar-item">
                            <Link href="/admin/types"  :class="{ 'active': ['Type/Index', 'Complain/Question/Questions', 'Complain/Question/Add'].includes($page.component) }" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
                                <i class="fa-solid fa-list"></i>
                                <span class="hide-menu">Types</span>
                            </Link>
                        </li>
                        <li class="sidebar-item">
                            <Link href="/admin/users" :class="{ 'active': ['User/Index', 'User/Add', 'User/Update'].includes($page.component) }" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                                <span class="hide-menu">Users</span>
                            </Link>
                        </li>
                    </ul>
                    <Link method="POST" href="/logout" class="btn btn-danger mt-3 rounded-md" style="width: 90%; background: #fa5838 !important; margin-left: 5%;">
                        <span class="mr-3">Logout</span>
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </Link>
                </nav>
                <!-- End Sidebar navigation -->

                <div class="loggedin-user" style="padding-left: 15px;">
                    <p>Loggedin as: <span style="font-weight: bold;">{{ $page.props.auth.user.name }}</span></p>
                </div>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid mb-2">
                <slot></slot>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                Developed by Hashim Abbas
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
</template>
