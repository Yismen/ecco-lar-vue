<script>
    import Table from './_Table'
    export default {

        name: 'LastWeek',

        props: ['records'],

        components: {
            'results-table': Table
        }
    };
</script>

<template>
    <div class="_LastWeek">
        <div class="box box-primary">
            <results-table :records="records">Last Week Escal Records</results-table>
        </div>
    </div>
</template>

<style lang="css" scoped>
</style>