<template>
    <Head title="Data Menu" />

    <App>
        <template #breadcrumb>
            <bread-crumb-comp :title="'Dashboard'" :href="route('home')" :active="false"/>
            <bread-crumb-comp :title="'Data Menu'" :href="route('menus.index')" :active="true"/>
        </template>

        <template #actions>
            <button id="btn-menu-add" class="btn btn-default">Tambah Data</button>
        </template>

        <blank-modal-comp :target="'add-menu-modal'" :title="'Tambah data menu'">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" @submit.prevent="postStoreMenu" id="form-menu-modal">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                    </div>
                                    <input class="form-control" id="nama_menu-field" name="nama_menu" placeholder="Nama Menu" type="text"
                                        v-model="formMenu.nama_menu">
                                </div>
                                    <div class="invalid-feedback d-block" v-if="$page.props.errors.nama_menu"><i class="fas fa-arrow-up"></i> {{$page.props.errors.nama_menu}} </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                    </div>
                                    <input class="form-control" id="harga-field" name="harga" placeholder="Harga Menu" type="text"
                                        v-model="formMenu.harga">
                                </div>
                                    <div class="invalid-feedback d-block" v-if="$page.props.errors.harga"><i class="fas fa-arrow-up"></i> {{$page.props.errors.harga}} </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-scroll"></i></span>
                                    </div>
                                    <textarea class="form-control" id="deskripsi-field" name="deskripsi" placeholder="Deskripsi Menu"
                                        v-model="formMenu.deskripsi"></textarea>
                                </div>
                                    <div class="invalid-feedback d-block" v-if="$page.props.errors.deskripsi"><i class="fas fa-arrow-up"></i> {{$page.props.errors.deskripsi}} </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-th-list"></i></span>
                                    </div>
                                    <input class="form-control" id="stok-field" name="stok" placeholder="Stok / Ketersediaan Menu" type="text"
                                        v-model="formMenu.stok">
                                </div>
                                    <div class="invalid-feedback d-block" v-if="$page.props.errors.stok"><i class="fas fa-arrow-up"></i> {{$page.props.errors.stok}} </div>
                            </div>                            

                            <button type="submit" :class="{'opacity-25' : formMenu.processing}" :disabled="formMenu.processing" class="btn btn-block btn-primary mt-3 mb-3" id="btn-save-menu">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </blank-modal-comp>

        <div class="row">
            <div class="col">
                <div class="card bg-default shadow">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-0">Data Menu</h3>
                    </div>
                    <div class="table-responsive">
                    <table class="table align-items-center table-dark table-flush" id="data-menu">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Nama Menu</th>
                                <th scope="col" class="sort" data-sort="budget">Harga</th>
                                <th scope="col" class="sort" data-sort="budget">Deskripsi</th>
                                <th scope="col" class="sort" data-sort="budget">Stok</th>
                                <th scope="col" class="sort" data-sort="budget">Ditambah Oleh</th>
                                <th scope="col" class="sort" data-sort="budget">Ditambah Pada</th>
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
    import BlankModalComp from '@/Components/Modals/BlankModalComp.vue';
    export default {
        components: {
            Head,
            App,
            BreadCrumbComp,
            BlankModalComp,
        },
        data() {
            return {
                tableMenu: null,
                formMenu: this.$inertia.form({
                    nama_menu: "",
                    harga: "",
                    deskripsi: "",
                    stok: "",
                })
            }
        },
        methods: {
            getMenuList(){
                var ajaxUser = this.route('data.menus');
                this.tableMenu = $('#data-menu').DataTable({
                    processing: false,
                    serverSide: true,
                    ajax: ajaxUser,
                    columns: [
                        { data: 'nama_menu' },
                        { data: 'harga' },
                        { data: 'deskripsi' },
                        { data: 'stok' },
                        { data: 'created_by',  sortable: false },
                        { data: 'created',  sortable: false },
                        { data: 'action', searchable: false, sortable: false },
                    ],
                    responsive: false,
                    language: {
                        oPaginate: {
                            sNext: '<i class="fa fa-forward"></i>',
                            sPrevious: '<i class="fa fa-backward"></i>',
                            sFirst: '<i class="fa fa-step-backward"></i>',
                            sLast: '<i class="fa fa-step-forward"></i>'
                        }
                    },
                });
            },
            postStoreMenu(){
                this.formMenu.processing = true;
                this.formMenu.post(this.route('menus.store'), {
                    onSuccess: () => {
                        $('#add-menu-modal').modal('hide');
                        this.formMenu.processing = false;
                        this.tableMenu.ajax.reload();
                        Snackbar.show({
                            text: 'Menu berhasil ditambahkan',
                            actionText: 'Tutup',
                            backgroundColor: '#383838',
                            textColor: '#fff',
                            showAction: false,
                            duration: 3000
                        });
                        this.formMenu.reset();
                    }
                })
            }
        },
        mounted(){
            var formMenu = this.formMenu;
            if(this.tableMenu == null){
                Snackbar.show({
                    text: 'Mendapatkan data menu...',
                    showAction: false,
                    backgroundColor: '#e74c3c',
                    textColor: '#fff',
                    customClass: 'mt-5'
                });
            }
            this.getMenuList();
            var tableMenu = this.tableMenu;
            $('#btn-menu-add').on('click', function(){
                $('#add-menu-modal').modal('show');
                $('#add-menu-modal .modal-title').text('Tambah Menu');
                formMenu.reset();
            });

            // edit
            $(document).on('click', '#btn-menu-edit', function(){
                Snackbar.show({
                    text: "Menampilkan data menu..."
                })
                var id = $(this).data('id');
                axios.get(`/menus/${id}`).then(response => {
                    var {menu} = response.data.data;
                    $('#add-menu-modal').modal('show');
                    $('#add-menu-modal .modal-title').text('Edit Menu');
                    formMenu.nama_menu = menu.nama_menu;
                    formMenu.harga = menu.harga;
                    formMenu.deskripsi = menu.deskripsi;
                    formMenu.stok = menu.stok;
                    $('#add-menu-modal #btn-save-menu').attr('type', 'button').on('click', function(){
                        formMenu.processing = true;
                        formMenu.put(`/menus/${id}`, {
                            onSuccess: () => {
                                $('#add-menu-modal').modal('hide');
                                formMenu.processing = false;
                                formMenu.reset();
                                Snackbar.show({
                                    text: 'Menu berhasil diubah',
                                    actionText: 'Tutup',
                                    backgroundColor: '#383838',
                                    textColor: '#fff',
                                    showAction: false,
                                    duration: 3000
                                });
                                tableMenu.ajax.reload();
                            }
                        })
                    });
                    $('#add-menu-modal #form-menu-modal').on('submit', (e)=>{
                        e.preventDefault();
                        return false;
                    })
                });
            });

            // delete
            $(document).on('click', '#btn-menu-delete', function(){
                Swal.fire({
                    title: 'Hapus Menu',
                    text: "Apakah anda yakin ingin menghapus menu ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.value) {
                        var id = $(this).data('id');
                        axios.delete(`/menus/${id}`).then(response => {
                            var {message} = response.data;
                            Snackbar.show({
                                text: message,
                                actionText: 'Tutup',
                                backgroundColor: '#383838',
                                textColor: '#fff',
                                showAction: false,
                                duration: 3000
                            });
                            tableMenu.ajax.reload();
                        });
                    }
                })
            });
        }
    }
</script>