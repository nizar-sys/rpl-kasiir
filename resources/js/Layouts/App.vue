<template>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center justify-content-center">
                <Link class="navbar-brand"
                    :href="route('home')">
                    <img src="/assets/img/brand/blue.png" class="navbar-brand-img" alt="Brand">
                </Link>
                <div class="pr-3 sidenav-toggler sidenav-toggler-white d-lg-none" data-action="sidenav-pin"
                    data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <menu-single-comp :href="route('home')" title="Dashboard" icon="ni ni-tv-2 text-primary" :active="route().current('home')"/>
                        <!-- admin menu -->
                        <div v-if="$page.props.auth.user.role == 'admin'">
                            <menu-single-comp :href="route('users.index')" title="Data Pengguna" icon="fas fa-users text-warning" :active="route().current('users.index')"/>
                        </div>
                        <div v-else-if="$page.props.auth.user.role == 'manager'">
                            <menu-single-comp :href="route('menus.index')" title="Data Menu" icon="fas fa-birthday-cake text-success" :active="route().current('menus.index')"/>
                            <menu-single-comp :href="route('transaksis.index')" title="Laporan Transaksi" icon="fas fa-building text-danger" :active="route().current('transaksis.index')"/>
                        </div>
                        <div v-else>
                            <menu-single-comp :href="route('transaksis.index')" title="Transaksi" icon="fas fa-building text-danger" :active="route().current('transaksis.index')"/>
                            <menu-single-comp :href="route('transaksis.create')" title="Transaksi Baru" icon="fas fa-building text-primary" :active="route().current('transaksis.create')"/>
                        </div>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                </div>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Search form -->
                    <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                        <div class="form-group mb-0">
                            <div class="input-group input-group-alternative input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input class="form-control" placeholder="Search"
                                    type="text">
                            </div>
                        </div>
                        <button type="button" class="close" data-action="search-close"
                            data-target="#navbar-search-main" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </form>
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center  ml-md-auto ">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item d-sm-none">
                            <a class="nav-link" href="#" data-action="search-show"
                                data-target="#navbar-search-main">
                                <i class="ni ni-zoom-split-in"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="ni ni-bell-55"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                                <!-- Dropdown header -->
                                <div class="px-3 py-3">
                                    <h6 class="text-sm text-muted m-0">You have <strong
                                            class="text-primary">13</strong> notifications.</h6>
                                </div>
                                <!-- List group -->
                                <div class="list-group list-group-flush">
                                    <a href="#!" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <img alt="Image placeholder"
                                                    src="/assets/img/theme/team-1.jpg"
                                                    class="avatar rounded-circle">
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="mb-0 text-sm">John Snow</h4>
                                                    </div>
                                                    <div class="text-right text-muted">
                                                        <small>2 hrs ago</small>
                                                    </div>
                                                </div>
                                                <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- View all -->
                                <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View
                                    all</a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder"
                                            src="/assets/img/theme/vue.jpg">
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm font-weight-bold" v-if="$page.props.auth.user">{{$page.props.auth.user.username}}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right" v-if="$page.props.auth.user">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome!</h6>
                                </div>
                                <a href="#" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>My profile</span>
                                </a>
                                <Link :href="route('profile.activities')" class="dropdown-item">
                                    <i class="ni ni-calendar-grid-58"></i>
                                    <span>Activity</span>
                                </Link>
                                <div class="dropdown-divider"></div>
                                <form @submit.prevent="logout" id="logout-form" method="post" class="d-none"></form>
                                <Link :href="'/logout'" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>Logout</span>
                                </Link>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7" v-if="$slots.breadcrumb">
                            <nav aria-label="breadcrumb" class="ml-sm-12 d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <slot name="breadcrumb"/>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right" v-if="$slots.actions">
                            <slot name="actions"/>
                        </div>
                    </div>
                    <!-- Card stats -->
                    <div class="row" id="widgetsItems" v-if="$slots.widgets">
                        <slot name="widgets"/>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <main class="container-fluid mt--6" id="parent-content">

            <slot id="content">
                
            </slot>

            <!-- Footer -->
            <footer class="footer pt-0">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6">
                        <div class="copyright text-center  text-lg-left  text-muted">
                            Copyright&copy; 2022 <a href="https://www.creative-tim.com"
                                class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
                        </div>
                    </div>
                </div>
            </footer>
        </main>
    </div>
</template>

<script>
    import {Link} from '@inertiajs/inertia-vue3';
    import MenuSingleComp from '@/Components/MenuSingleComp.vue';
    export default {
        components: {
            Link,
            MenuSingleComp,
        },
        mounted() {
            document.getElementsByTagName('body')[0].classList.remove('bg-default');
            if(this.$page.props.flash) {
                if(this.$page.props.flash.success != null) {
                    Snackbar.show({
                        text: this.$page.props.flash.success,
                        actionText: 'Close',
                        backgroundColor: '#28a745',
                        actionTextColor: '#fff',
                        duration: 5000
                    });
                } else if(this.$page.props.flash.error != null) {
                    Snackbar.show({
                        text: this.$page.props.flash.error,
                        actionText: 'Close',
                        backgroundColor: '#dc3545',
                        actionTextColor: '#fff',
                        duration: 5000
                    });
                } else if(this.$page.props.flash.info != null) {
                    Snackbar.show({
                        text: this.$page.props.flash.info,
                        actionText: 'Close',
                        backgroundColor: '#ffc107',
                        actionTextColor: '#fff',
                        duration: 5000
                    });
                }
            }
        },
        data(){
            return {
                formLogout: this.$inertia.form({
                }),
            }
        },
        methods: {
            logout() {
                this.formLogout.post('logout');
            },
        }
    }
</script>
