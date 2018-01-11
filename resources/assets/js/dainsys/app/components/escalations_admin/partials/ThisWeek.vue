<script>
    import Table from './_Table'
    export default {

        name: 'ThisWeek',

        props: ['records'],

        components: {
            'results-table': Table
        }
    };
</script>

<template>
    <div class="_ThisWeek">
        <div class="box box-primary">
            <results-table :records="records">This Week Escal Records</results-table>
        </div>
    </div>
</template>

<style lang="css" scoped>
</style>