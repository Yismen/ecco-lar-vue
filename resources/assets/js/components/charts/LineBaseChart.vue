<template>
    <line-chart
        :labels="labels"
        :datasets="datasets"
        :options="options"
        :height="200"
    ></line-chart>
</template>

<script>
    import LineChart from './LineChart'

    export default {
        props: {
            goal: {default: null},
            labels: {required: true, type: Array},
            datasets: {required:true, type: Array},
        },
        data() {
            return {
                options: {
                    label: {display: true},
                    legend: {display: false},
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    }
                }
            }
        },
        created() {
            if (this.goal) {
                let data = []
                this.datasets[0].data.forEach(element => {
                    data.push(this.goal)
                });

                this.datasets.unshift({
                    data: data,
                    borderColor: 'rgba(211,47,47 ,1)',
                    backgroundColor: 'rgba(211,47,47 , .25)',
                    label: 'Goal'
                })
            }
            this.datasets.forEach((item) => {
                item.data = item.data.map((value) => {return Number(value, 2)})
            })
        },
        components: {
            LineChart
        },
    }
</script>
