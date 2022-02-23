<template>
    <div class="modal fade" id="modalSetStatus" tabindex="-1" role="dialog" aria-labelledby="modalSetStatusLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSetStatusLabel">Ubah Status Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" @submit.prevent="postSetStatus" id="form-set-status">
                    <input type="hidden" name="status" id="status" v-model="form.status"/>
                    <input type="hidden" id="pengaduan_id" name="id" v-model="form.id"/>
                    <div class="container-fluid">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-6 col-sm-12 col-lg-6">
                                <button class="btn btn-block btn-primary" @click.prevent="setStatus" id="setujubtn" value="disetujui">Setujui</button>
                            </div>
                            <div class="col-md-6 col-sm-12 col-lg-6">
                                <button class="btn btn-block btn-danger" @click.prevent="setStatus" id="tolakbtn" value="ditolak">Tolak</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: this.$inertia.form({ 
                    id: '',
                    status: '',
                }),
            }
        },
        methods:{
            postSetStatus(){
                this.form.post(this.route('pengaduan.set.status'), {
                    onFinish: () => {
                        $('#modalSetStatus').modal('hide')
                        Snackbar.show({
                            pos: 'top-center',
                            text: 'Status Pengaduan berhasil diubah',
                            actionText: 'OK',
                            actionTextColor: '#fff',
                            backgroundColor: '#383838',
                            showAction: true,
                            duration: 3000,
                        });
                    }
                })
            },
            setStatus(e) {
                this.form.status = e.target.value
                this.form.id = $('#pengaduan_id').val()
                this.postSetStatus()
            }
        }
    }
</script>