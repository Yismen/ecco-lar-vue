<script>
    import Table from './_Table'
    export default {

        name: 'LastMonth',

        props: ['records'],

        components: {
            'results-table': Table
        }
    };
</script>

<template>
    <div class="_LastMonth">
        <div class="box box-danger">
            <results-table :records="records">Last Month Escal Records</results-table>
        </div>
    </div>
</template>

<style lang="css" scoped>
</style>