<template>
    <bar-chart
        :labels="labels"
        :datasets="datasets"
        :options="mergedOptions"
        :height="200"
    ></bar-chart>
</template>

<script>
    import BarChart from './BarChart'

    export default {
        props: {
            goal: {default: null},
            labels: {required: true, type: Array},
            datasets: {required:true, type: Array},
            options: {}
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
        },
        components: {
            BarChart
        },
        computed: {
            mergedOptions() {
                return Object.assign({ 
                    maintainAspectRatio: false ,
                    label: {display: true},
                    legend: {display: false},
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(value, index, values) {                                    
                                    return value.toLocaleString()
                                }
                            }
                        }]
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(TooltipItem, data) {
                                var label = data.datasets[TooltipItem.datasetIndex].label || ''

                                 if (label) {
                                    label += ': ';
                                }

                                let returnValue = ''
                                
                                let value = TooltipItem.yLabel.toString() // get the value and convert to string    
                                
                                value.split(",").forEach(function(item) {
                                    return returnValue += item
                                })// split the value and iterate to generate new value 
                                
                                return label += Number(returnValue, 2).toLocaleString()
                            }
                        }
                    },
                    // scales: {
                    //     yAxes: [
                    //         {
                    //             type: 'linear',
                    //             display: true,
                    //             position: 'left',
                    //             id: 'y1',
                    //             gridLines: {
                    //                 drawOnChartArea: true, 
                    //             },
                    //         },
                    //         {
                    //             type: 'linear', 
                    //             display: true,
                    //             position: 'right',
                    //             id: 'y2',
                    //             gridLines: {
                    //                 drawOnChartArea: false,
                    //             },
                    //         }
                    //     ]
                    // },
                }, this.options)
            }
        }
    }
</script>
