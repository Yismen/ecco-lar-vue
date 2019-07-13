<template src="./Rotations.html" />

<script>
    import RotationsContract from './RotationsContract'

    export default {
        name: "ThisMonthRotations",
        mixins: [RotationsContract],
        data() {
            return {
                defaultTitle: "Rotations This Month"
            }
        }
    }
</script>

<style lang="css" scoped>
</style>
