<template src="./Rotations.html" />

<script>
    import RotationsContract from './RotationsContract'

    export default {
        name: "RotationsLastYear",
        mixins: [RotationsContract],
        data() {
            return {
                defaultTitle: "Rotations Last Month"
            }
        }
    }
</script>

<style lang="css" scoped>
</style>
