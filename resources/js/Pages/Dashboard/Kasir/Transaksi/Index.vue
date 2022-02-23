<template>
    <Head title="Transaksi" />

    <App>
        <template #breadcrumb>
            <bread-crumb-comp :title="'Dashboard'" :href="route('home')" :active="false"/>
            <bread-crumb-comp :title="'Transaksi'" :href="route('transaksis.index')" :active="true"/>
        </template>
        
        <template #widgets>
            <widgets-comp title="Total pendapatan" :data="'Rp. ' + $page.props.total_pendapatan" :icon="'fas fa-money-wave'" :desc="'Total pendapatan'"/>
        </template>

        <template #actions>
            <trigger-modal-comp :content="'Filter Transaksi'" :target="'filter-modal'" :class="'btn btn-default'" v-if="$page.props.auth.user.role == 'manager'"/>
            <Link :href="route('transaksis.create')" class="btn btn-default sm-d-block" v-else>Buat transaksi</Link>
        </template>

        <blank-modal-comp :target="'filter-modal'" :title="'Filter transaksi'" v-if="$page.props.auth.user.role == 'manager'">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row" id="pass-group">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input class="form-control" name="form_date" placeholder="Jangka tanggal transaksi" type="text"
                                            id="form_date-field">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </blank-modal-comp>

        <div class="row">
            <div class="col">
                <div class="card bg-default shadow">
                    <div class="card-header bg-transparent border-0">
                        <button @click.prevent="reloadTableTransaksi" class="btn btn-secondary float-right btn-sm"><i class="fas fa-sync-alt"></i></button>
                        <h3 class="text-white mb-0">Data Transaksi</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-dark table-flush" id="data-transaksi">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">nama pelanggan</th>
                                    <th scope="col" class="sort" data-sort="budget">nama menu</th>
                                    <th scope="col" class="sort" data-sort="budget">Jumlah</th>
                                    <th scope="col" class="sort" data-sort="budget">Total harga</th>
                                    <th scope="col" class="sort" data-sort="budget">nama kasir</th>
                                    <th scope="col" class="sort" data-sort="budget">Tanggal</th>
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
    import {Head, Link} from '@inertiajs/inertia-vue3';
    import App from '@/Layouts/App.vue';
    import BreadCrumbComp from '@/Components/BreadCrumbComp.vue';
    import BlankModalComp from '@/Components/Modals/BlankModalComp.vue';
    import TriggerModalComp from '@/Components/Modals/TriggerModalComp.vue';
    import WidgetsComp from '@/Components/WidgetsComp.vue';
    export default {
        components: {
            Head,
            App,
            BreadCrumbComp,
            BlankModalComp,
            TriggerModalComp,
            Link,
            WidgetsComp,
        },
        data() {
            return {
                tableTransaksi: null,
            }
        },
        methods: {
            getDataTransaksi(){
                var ajaxTransaksi = this.route('data.transaksis');
                this.tableTransaksi = $('#data-transaksi').DataTable({
                    processing: false,
                    serverSide: true,
                    ajax: ajaxTransaksi,
                    columns: [
                        { data: 'nama_pelanggan'},
                        { data: 'nama_menu'},
                        { data: 'jumlah'},
                        { data: 'total_harga'},
                        { data: 'kasir'},
                        { data: 'tanggal'},
                        // { data: 'action', searchable: false, sortable: false},
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
            },
            reloadTableTransaksi(){
                this.tableTransaksi.ajax.url('/get-transaksis').load();
                Snackbar.show({
                    text: 'Data transaksi berhasil diperbarui',
                    showAction: false,
                    actionText: 'Dismiss',
                    backgroundColor: '#383838',
                    textColor: '#fff',
                });
            }
        },
        mounted(){
            if(this.tableTransaksi == null){
                Snackbar.show({
                    text: 'Mendapatkan data transaksi...',
                    backgroundColor: '#00C851',
                });
            }
            $(document).ready(()=>{
                this.getDataTransaksi();
                var tableTransaksi = this.tableTransaksi;
                $('#form_date-field').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear'
                    }
                });

                $('#form_date-field').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                    tableTransaksi.ajax.url(`/get-transaksis?date_from=${picker.startDate.format('YYYY-MM-DD')}&date_to=${picker.endDate.format('YYYY-MM-DD')}`).load()

                    // close modal
                    $('#filter-modal').modal('hide');

                    Snackbar.show({
                        text: 'Mendapatkan data transaksi...',
                        backgroundColor: '#00C851',
                    });
                });

                // on cancel
                $('#form_date-field').on('cancel.daterangepicker', (ev, picker) => {
                    $('#form_date-field').val('')
                    tableTransaksi.ajax.url('/get-transaksis').load()
                });
            });
        },
    }
</script>