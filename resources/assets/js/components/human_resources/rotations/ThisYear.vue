<template src="./Rotations.html" />
<script>
    import RotationsContract from './RotationsContract'

    export default {
        name: "ThisYearRotations",
        mixins: [RotationsContract],
        data() {
            return {
                defaultTitle: "Rotations This Year"
            }
        }
    }
</script>

<style lang="css" scoped>
</style>
