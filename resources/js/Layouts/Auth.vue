<template>
    <!-- Navbar -->
    <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
        <div class="container">
            <Link class="navbar-brand" :href="'/'">
                <img src="/assets/img/brand/white.png">
            </Link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse"
                aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <Link :href="route('login')">
                                <img src="/assets/img/brand/blue.png">
                            </Link>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <Link :href="route('login')" class="nav-link">
                            <span class="nav-link-inner--text">Login</span>
                        </Link>
                    </li>
                </ul>
                <hr class="d-lg-none" />
                <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                    <li class="nav-item">
                        <Link class="nav-link nav-link-icon" href="https://www.instagram.com/emnizaar" target="_blank"
                            data-toggle="tooltip" data-original-title="Follow us on Instagram">
                            <i class="fab fa-instagram"></i>
                            <span class="nav-link-inner--text d-lg-none">Instagram</span>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link nav-link-icon" href="https://twitter.com/jokiicode" target="_blank"
                            data-toggle="tooltip" data-original-title="Follow us on Twitter">
                            <i class="fab fa-twitter-square"></i>
                            <span class="nav-link-inner--text d-lg-none">Twitter</span>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link nav-link-icon" href="https://github.com/nizar-sys" target="_blank"
                            data-toggle="tooltip" data-original-title="Star us on Github">
                            <i class="fab fa-github"></i>
                            <span class="nav-link-inner--text d-lg-none">Github</span>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link nav-link-icon" href="mailto:nizarid04@email.com" target="_blank"
                            data-toggle="tooltip" data-original-title="Mail us on Email">
                            <i class="fas fa-envelope"></i>
                            <span class="nav-link-inner--text d-lg-none">Mail</span>
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <slot></slot>
    </main>
</template>

<script>
    import {Link} from '@inertiajs/inertia-vue3';

    export default {
        components: {
            Link
        },
        mounted() {
            document.getElementsByTagName('body')[0].classList.add('bg-default');
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
        }
    }
</script>
