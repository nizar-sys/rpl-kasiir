<template>
    <button type="button" :class="class" data-toggle="modal" :data-target="'#'+target">
        {{ content }}
    </button>
</template>

<script>
    export default {
        props: ['target', 'class', 'content'],
    }
</script>