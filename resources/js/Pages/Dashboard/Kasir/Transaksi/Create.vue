<template>
    <Head title="Buat transaksi" />
    <App>
        <template #breadcrumb>
            <bread-crumb-comp :title="'Dashboard'" :href="route('home')" :active="false"/>
            <bread-crumb-comp :title="'Transaksi'" :href="route('transaksis.index')" :active="false"/>
            <bread-crumb-comp :title="'Transaksi Baru'" :href="route('transaksis.create')" :active="true"/>
        </template>

        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-5">
                <div class="card bg-default shadow">
                    <div class="card-header bg-transparent border-0">
                        <button @click.prevent="reloadMenu" class="btn btn-sm btn-secondary float-right"><i class="fas fa-sync-alt"></i></button>
                        <h3 class="text-white mb-3">
                            Daftar Menu
                        </h3>
                        <div class="table-responsive">
                            <table class="table align-items-center table-dark table-flush" id="data-menu">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="budget">nama menu</th>
                                        <th scope="col" class="sort" data-sort="budget">harga</th>
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
            <div class="col-sm-12 col-md-7 col-lg-7">
                <div class="card bg-default shadow">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-3">
                            Daftar Transaksi
                        </h3>
                        <div class="table-responsive">
                            <table class="table align-items-center table-dark table-flush" id="data-transaksi">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="budget">nama menu</th>
                                        <th scope="col" class="sort" data-sort="budget">pelanggan</th>
                                        <th scope="col" class="sort" data-sort="budget">harga</th>
                                        <th scope="col" class="sort" data-sort="budget">jumlah</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <tr v-if="daftarTransaksi.length == 0">
                                        <td class="text-center">Tidak ada data</td>
                                    </tr>
                                    <tr v-for="(transaksi, i) in daftarTransaksi" :key="i" v-else>
                                        <td>{{transaksi.nama_menu}}</td>
                                        <td>
                                            <input class="form-control" name="pelanggan[]"/>
                                        </td>
                                        <td>{{transaksi.harga}}</td>
                                        <td>
                                            {{transaksi.jumlah}}
                                            <input type="hidden" disabled class="form-control" name="jumlah[]" :data-id="transaksi.id" :value="transaksi.jumlah" min="1" :max="transaksi.maxQty">
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger fas fa-trash" @click.prevent="removeDaftarTransaksi" :data-id="transaksi.id">
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card bg-default shadow" v-if="daftarTransaksi.length > 0">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-3">
                            Total transaksi
                        </h3>
                        <div class="table-responsive">
                            <table class="table align-items-center table-dark table-flush">
                                <tbody class="list">
                                    <tr>
                                        <td>Total Menu</td>
                                        <td>{{daftarTransaksi.length}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Harga</td>
                                        <td>{{
                                            'Rp. ' + daftarTransaksi.reduce(function(a, b){
                                                return a + parseInt(b.harga.replace(/[^0-9]/g, ''));
                                            }, 0)  
                                        }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary btn-block fas fa-plus" @click.prevent="createTransaksi">
                                                Simpan Transaksi
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    export default {
        props: ['users'],
        components: {
            Head,
            App,
            BreadCrumbComp,
        },
        data(){
            return {
                tableMenu: null,
                pelangganList: {},
                daftarTransaksi: [],
            }
        },
        methods: {
            getMenu(){
                var ajaxUser = this.route('data.menus');
                this.tableMenu = $('#data-menu').DataTable({
                    processing: false,
                    serverSide: true,
                    ajax: ajaxUser,
                    columns: [
                        { data: 'nama_menu' },
                        { data: 'harga' },
                        { data: 'action_cart', searchable: false, sortable: false },
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
            reloadMenu(){
                this.tableMenu.ajax.reload()
            },
            removeDaftarTransaksi(e){
                var data = this.daftarTransaksi.find((transaksi, i) => {
                    transaksi.id == e.target.dataset.id ? this.daftarTransaksi.splice(i, 1) : null;
                });
            },
            createTransaksi(e){
                var user = this.$page.props.auth.user
                var today = new Date();
                var date = `${today.getFullYear()}-${today.getMonth() < 10 ? '0' + (today.getMonth()+1) : (today.getMonth()+1)}-${today.getDate()} ${today.getHours()}:${today.getMinutes()}:${today.getSeconds()}`;
                var data = this.daftarTransaksi.map(function(transaksi, i){
                    if($('input[name="pelanggan[]"]').eq(i).val() == ''){
                        Snackbar.show({
                            text: "Harap isi nama pelanggan",
                        })
                        $('input[name="pelanggan[]"]').eq(i).addClass('is-invalid')
                        return false;
                    } else {
                        return {
                            nama_pelanggan: $('input[name="pelanggan[]"]').eq(i).val(),
                            menu_id: transaksi.id,
                            jumlah: transaksi.jumlah,
                            total_harga: parseInt(transaksi.harga.split(' ')[1].replace(/[^0-9]/g, '')),
                            kasir_id: user.id,
                            created_at: date,
                        }
                    }
                });
                data.map(a => {
                    if(!a){
                        return false;
                    } else {
                        e.target.setAttribute('disabled', true)
                
                        axios.post(`/transaksis`, a).then(response => {
                            e.target.removeAttribute('disabled')
                            var {message} = response.data
                            var {data} = response.data
                            Snackbar.show({
                                text: message
                            })
                            this.daftarTransaksi.splice(a, 1);
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                })
            }
        },
        mounted(){
            this.getMenu();
            this.pelangganList = this.$props.users;
            // add to daftar Transaksi
            var daftarTransaksi = this.daftarTransaksi;
            function convertRp(numb) {
                var format = numb.toString().split('').reverse().join('');
                var convert = format.match(/\d{1,3}/g);
                return convert.join('.').split('').reverse().join('')
            }
            $('#data-menu').on('click', '#btn-menu-cart', function(e){
                let data = daftarTransaksi.find(function(item){
                    return item.id == $(e.target).data('id');
                });
                if(data){
                    data.jumlah++;
                    data.harga = 'Rp. ' + convertRp(parseInt($(e.target).data('harga')) * parseInt(data.jumlah));
                }else{
                    daftarTransaksi.push({
                        id: $(this).data('id'),
                        nama_menu: $(this).data('nama_menu'),
                        harga: 'Rp. ' + convertRp($(this).data('harga')),
                        jumlah: 1,
                        maxQty: $(this).data('max_qty'),
                    });
                }
            });
        },
    }
</script>