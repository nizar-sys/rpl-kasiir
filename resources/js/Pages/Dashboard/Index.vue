<template>
    <Head title="Dashboard" />

    <App>
        <template #breadcrumb>
            <bread-crumb-comp :title="'Dashboard'" :href="route('home')" :active="true"/>
        </template>
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
            BreadCrumbComp
        },
    }
</script>