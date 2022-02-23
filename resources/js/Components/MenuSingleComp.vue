<template>
    <li class="nav-item">
        <Link :class="classes" :href="href">
        <i :class="icon"></i>
        <span class="nav-link-text">{{ title }}</span>
        </Link>
    </li>    
</template>

<script>
    import {Link} from '@inertiajs/inertia-vue3';
    export default {
        props: ['href', 'title', 'icon', 'active'],
        components: {
            Link
        },
        computed: {
            classes() {
                return this.active ? 'nav-link active' : 'nav-link'
            }
        }
    }
</script>