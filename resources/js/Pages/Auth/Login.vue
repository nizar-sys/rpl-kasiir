<template>
    <Head title="Login" />
    <Auth>
        <!-- Main content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
                <div class="container">
                    <div class="header-body text-center mb-7">
                        <div class="row justify-content-center">
                            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                                <h1 class="text-white">Welcome!</h1>
                                <p class="text-lead text-white">Use these awesome forms to login or create new account for free.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="separator separator-bottom separator-skew zindex-100">
                    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                        xmlns="http://www.w3.org/2000/svg">
                        <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                    </svg>
                </div>
            </div>
            <!-- Page content -->
            <div class="container mt--8 pb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-center text-muted mb-4">
                                    <small>Sign in with credentials</small>
                                </div>
                                <form role="form" @submit.prevent="postLogin" method="POST">

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input class="form-control" name="username" placeholder="Username" type="text"
                                                v-model="form.username">
                                        </div>
                                            <div class="invalid-feedback d-block" v-if="$page.props.errors.username"><i class="fas fa-arrow-up"></i> {{$page.props.errors.username}} </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control" name="password" placeholder="Password" type="password"
                                                id="password" v-model="form.password">
                                        </div>
                                        <div class="invalid-feedback d-block" v-if="$page.props.errors.password"><i class="fas fa-arrow-up"></i> {{ $page.props.errors.password }} </div>
                                    </div>

                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" name="remember" id="customCheckLogin"
                                            type="checkbox" v-model="form.remember">
                                        <label class="custom-control-label" for="customCheckLogin">
                                            <span class="text-muted">Remember me</span>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary my-4" :class="{'opacity-25' : form.processing}" :disabled="form.processing">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <a @click.prevent="forgotPassRedirect" class="text-light"><small>Forgot
                                        password?</small></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Auth>
</template>

<script >
    import Auth from '@/Layouts/Auth.vue';
    import {Head} from '@inertiajs/inertia-vue3';
    export default {
        components: {
            Auth,
            Head
        },
        data() {
            return {
                form: this.$inertia.form({
                    username: "",
                    password: "",
                    remember: false,
                })
            }
        },
        methods: {
            postLogin() {
                this.form.post(this.route('post.login'), {
                    onFinish: () => this.form.reset(''),
                })
            },
            forgotPassRedirect() {
                this.$inertia.visit(route('password.request'), { method: 'get' });
            }
        }
    }
</script>
