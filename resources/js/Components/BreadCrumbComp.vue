<template>
    <li :class="classes">
        <Link :href="href">
            {{title}}
        </Link>
    </li>
</template>

<script>
    import {Link} from '@inertiajs/inertia-vue3';
    export default {
        components: {
            Link
        },
        props: {
            title: {
                required: true
            },
            href: {
                required: true
            },
            active: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            classes() {
                return {
                    'breadcrumb-item': true,
                    'active': this.active
                }
            }
        }
    }
</script>