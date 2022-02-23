<template>
    <div class="modal fade" :class="class" :id="target" tabindex="-1" role="dialog" :aria-labelledby="target+'Label'" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" :id="target+'Label'">{{ title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <slot class="modal-body">
                
            </slot>
            <div class="modal-footer" v-if="$slots.footerModal">
                <slot name="footerModal"/>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            target: {
                type: String,
                required: true
            },
            title: {
                type: String,
                required: true
            },
            class: {
                type: String,
                required: false
            }
        },
    }
</script>