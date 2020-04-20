<template>
    <doughnut-chart
        :labels="labels"
        :datasets="computedDataset"
        :options="options"
        :height="200"
    ></doughnut-chart>
</template>

<script>
    import DoughnutChart from './DoughnutChart'
    import {DAINSYS} from '../../config/app'
    
    export default {
        props: {
            labels: {required: true, type: Array},
            dataset: {required:true, type: Array},
        },
        data() {
            return {
                options: {
                    label: {display: true},
                    legend: {display: false},
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                }
            }
        },
        computed: {
            computedDataset() {                
                return [{
                    data: this.dataset,
                    backgroundColor: DAINSYS.getColors()
                }]
            }
        },
        components: {
            DoughnutChart
        },
    }
</script>
