<template>
    <Head title="Data Pengguna"/>
    <App>
        <template #breadcrumb>
            <bread-crumb-comp :title="'Dashboard'" :href="route('home')" :active="false"/>
            <bread-crumb-comp :title="'Data Pengguna'" :href="route('users.index')" :active="true"/>
        </template>

        <template #actions>
            <button id="btn-user-add" class="btn btn-default">Tambah Data</button>
        </template>

        <blank-modal-comp :target="'add-user-modal'" :title="'Tambah data pengguna'">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" @submit.prevent="postStoreUser" id="form-user-modal">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input class="form-control" id="username-field" name="username" placeholder="Username" type="text"
                                        v-model="formUser.username">
                                </div>
                                    <div class="invalid-feedback d-block" v-if="$page.props.errors.username"><i class="fas fa-arrow-up"></i> {{$page.props.errors.username}} </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <select v-model="formUser.role" id="role-field" class="form-control">
                                        <option value="" selected>---Pilih level---</option>
                                        <option v-for="role in roleList" :value="role">{{ role }}</option>
                                    </select>
                                </div>
                                    <div class="invalid-feedback d-block" v-if="$page.props.errors.role"><i class="fas fa-arrow-up"></i> {{$page.props.errors.role}} </div>
                            </div>

                            <div class="row" id="pass-group">
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control" name="password" placeholder="Password" type="password"
                                                id="password-field" v-model="formUser.password">
                                        </div>
                                        <div class="invalid-feedback d-block" v-if="$page.props.errors.password"><i class="fas fa-arrow-up"></i> {{ $page.props.errors.password }} </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control" name="password" placeholder="Password Confirmation" type="password"
                                                id="password_confirmation-field" v-model="formUser.password_confirmation">
                                        </div>
                                        <div class="invalid-feedback d-block" v-if="$page.props.errors.password_confirmation"><i class="fas fa-arrow-up"></i> {{ $page.props.errors.password_confirmation }} </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" :class="{'opacity-25' : formUser.processing}" :disabled="formUser.processing" class="btn btn-block btn-primary mt-3 mb-3" id="btn-save-user">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </blank-modal-comp>

        <div class="row">
            <div class="col">
                <div class="card bg-default shadow">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-0">Data Pengguna</h3>
                    </div>
                    <div class="table-responsive">
                    <table class="table align-items-center table-dark table-flush" id="data-pengguna">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Username</th>
                                <th scope="col" class="sort" data-sort="budget">Level</th>
                                <th scope="col" class="sort" data-sort="budget">Dibuat Pada</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </App>
</template>

<script>
    import {Head} from '@inertiajs/inertia-vue3';
    import App from '@/Layouts/App.vue';
    import BreadCrumbComp from '@/Components/BreadCrumbComp.vue';
    import TriggerModalComp from '@/Components/Modals/TriggerModalComp.vue';
    import BlankModalComp from '@/Components/Modals/BlankModalComp.vue';
    export default {
        props: ['users', 'roles'],
        components: {
            Head,
            App,
            BreadCrumbComp,
            TriggerModalComp,
            BlankModalComp,
        },
        data(){
            return {
                userList: {},
                tableUsers: null,
                formUser: this.$inertia.form({
                    username: "",
                    password: "",
                    password_confirmation: "",
                    role: "",
                }),
                roleList: {},
                userById: null,
            }
        },
        methods: {
            postStoreUser(){
                this.formUser.post(this.route('users.store'),{
                    onSuccess: () => {
                        $('#add-user-modal').modal('hide');
                        this.formUser.reset();
                        this.formUser.processing = false;
                        Snackbar.show({
                            text: 'Pengguna berhasil ditambahkan',
                            actionText: 'Tutup',
                            backgroundColor: '#38ef7d',
                            showAction: true,
                            actionTextColor: '#fff',
                        });
                        this.tableUsers.ajax.reload();
                    },
                })
            },
            getUsersList(){
                var ajaxUser = this.route('data.users');
                this.tableUsers = $('#data-pengguna').DataTable({
                    processing: false,
                    serverSide: true,
                    ajax: ajaxUser,
                    columns: [
                        { data: 'username'},
                        { data: 'role', sortable: false},
                        { data: 'created', sortable: false},
                        { data: 'action', searchable: false, sortable: false},
                    ],
                    responsive: true,
                    language: {
                        oPaginate: {
                            sNext: '<i class="fa fa-forward"></i>',
                            sPrevious: '<i class="fa fa-backward"></i>',
                            sFirst: '<i class="fa fa-step-backward"></i>',
                            sLast: '<i class="fa fa-step-forward"></i>'
                        }
                    },
                });
            }
        },
        mounted(){
            this.userList = this.$props.users;
            this.roleList = this.$props.roles;
            if(this.tableUsers == null){
                Snackbar.show({
                    text: 'Mendapatkan data pengguna...',
                    showAction: false,
                    backgroundColor: '#e74c3c',
                    textColor: '#fff',
                    customClass: 'mt-5'
                });
            }
            $(document).ready(()=>{
                this.getUsersList();
                var tableUser = this.tableUsers;
                var userById = this.userById;

                var formUser = this.formUser;
                $(document).on('click', '#btn-user-edit', function(){
                    var id = $(this).data('id');
                    Snackbar.show({
                        text: 'Mendapatkan data pengguna...',
                        showAction: false,
                        backgroundColor: '#e74c3c',
                        textColor: '#fff',
                        customClass: 'mt-5'
                    });
                    axios.get(`/users/${id}`).then(response => {
                        var {users} = response.data.data;
                        userById = users;
                        formUser.username = users.username;
                        formUser.role = users.role;
                        $('#add-user-modal').modal('show');
                        $('#username-field').val(users.username);
                        $('#role-field').val(users.role).attr('selected', 'selected');
                        $('#pass-group').addClass('d-none');
                        $('#btn-save-user').text('Simpan').attr('type', 'button').on('click', function(){
                            formUser.put(`/users/${id}`, {
                                onSuccess: () => {
                                    $('#add-user-modal').modal('hide');
                                    formUser.reset();
                                    formUser.processing = false;
                                    Snackbar.show({
                                        text: 'Pengguna berhasil diubah',
                                        actionText: 'Tutup',
                                        backgroundColor: '#38ef7d',
                                        showAction: true,
                                        actionTextColor: '#fff',
                                    });
                                    tableUser.ajax.reload();
                                },
                            })
                        });
                        $('#add-user-modal .modal-title').text('Ubah Pengguna');
                        $('#add-user-modal #form-user-modal').on('submit', function(e){
                            e.preventDefault();
                            return false;
                        });
                    }).catch(error => {
                        console.log(error);
                    });
                });

                // add 
                $(document).on('click', '#btn-user-add', function(){
                    $('#add-user-modal').modal('show');
                    // set title modal
                    $('#add-user-modal .modal-title').text('Tambah data pengguna')
                    // set from value
                    $('#username-field').val('');
                    $('#role-field').val('');
                    $('#pass-group').removeClass('d-none');
                });

                // delete
                $(document).on('click', '#btn-user-delete', function(){
                    var id = $(this).data('id');
                    Swal.fire({
                        title: 'Hapus data pengguna?',
                        text: "Data pengguna akan dihapus secara permanen",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.value) {
                            axios.delete(`/users/${id}`).then(response => {
                                Snackbar.show({
                                    text: 'Data pengguna berhasil dihapus',
                                    showAction: false,
                                    backgroundColor: '#38ef7d',
                                    textColor: '#fff',
                                    customClass: 'mt-5'
                                });
                                tableUser.ajax.reload();
                            }).catch(error => {
                                console.log(error);
                            });
                        }
                    });
                });
            })
        },
    }
</script>