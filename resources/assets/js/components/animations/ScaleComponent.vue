<template>
    <div class='scale'>
        <slot></slot>
    </div>
</template>

<script>
export default {

    name: 'AnimateComponent'
}
</script>

<style lang="css" scoped>
    .scale {
        transition: transform .25s ease-in-out;
    }

    .scale:hover {
        transform: scale(1.2);
}
</style>
