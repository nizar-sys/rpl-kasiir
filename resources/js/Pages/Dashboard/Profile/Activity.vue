<template>
    <Head title="Kegiatan pengguna"/>

    <App>
        <template #breadcrumb>
            <bread-crumb-comp :title="'Dashboard'" :href="route('home')" :active="false"/>
            <bread-crumb-comp :title="'Kegiatan pengguna'" :href="route('profile.activities')" :active="true"/>
        </template>

        <div class="row">
            <div class="col">
                <div class="card bg-default shadow">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-0">Data Kegiatan</h3>
                    </div>
                    <div class="table-responsive">
                    <table class="table align-items-center table-dark table-flush" id="data-kegiatan">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Nama Kegiatan</th>
                                <th scope="col" class="sort" data-sort="name">Tanggal</th>
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
    export default {
        components: {
            Head,
            App,
            BreadCrumbComp,
        },
        data() {
            return {
                tableKegiatan: null,
            }
        },
        methods: {
            getKegiatan() {
                var ajaxActivity = this.route('data.activities');
                this.tableKegiatan = $('#data-kegiatan').DataTable({
                    processing: false,
                    serverSide: true,
                    ajax: ajaxActivity,
                    columns: [
                        { data: 'description' },
                        { data: 'tanggal' },
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
            }
        },
        mounted() {
            if(this.tableKegiatan == null){
                Snackbar.show('Menampilkan daftar kegiatan...')
            }
            this.getKegiatan()
        }
    }
</script>