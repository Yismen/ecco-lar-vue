<template>
    <div>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas commodi voluptatum ullam pariatur. Maiores ab voluptates sint consequatur labore? Iure officia quia facilis quod cum incidunt sunt voluptate voluptatibus. Accusantium?
    </div>    
</template>

<script>
    export default {
        name: "PositionsIndex",
        data() {
            return {
                positions: []
            }
        },
        created() {
            axios.get('/api/positions')
                .then(response => {
                    this.positions = response.data.data
                })
                .catch(errors => console.log(errors))
        },
    }
</script>

<style lang="css" scoped>

</style>