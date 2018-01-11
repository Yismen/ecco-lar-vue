<script>
    import Table from './_Table'
    export default {

        name: 'ThisMonth',

        props: ['records'],

        components: {
            'results-table': Table
        }
    };
</script>

<template>
    <div class="_ThisMonth">
        <div class="box box-warning">
            <results-table :records="records">This Month Escal Records</results-table>
        </div>
    </div>
</template>

<style lang="css" scoped>
</style>