<template>
    <div class="_CounthByMonth">
        <div class="box-header with-border">
            <h4>Monthly Movements</h4>
        </div>

        <div class="box-body">
            <canvas id="myChart" height="180px"></canvas>
        </div>
        
    </div>
</template>

<script>
    import Chart from 'chart.js';
    export default {
        name: 'CountByMonthComponent',

        data () {
            return {
                merged_array: [],
                labels: [],
                entrancesData: [],
                exitsData: [],
            };
        }, 

        props: {
            'rotations': {
                type: Object
            }
        },

        methods: {
            setMergedArray() {       
                for (var i = 0; i < this.rotations.entrances.length; i++) {
                    this.merged_array.push({
                        year: this.rotations.entrances[i].year, 
                        month: this.rotations.entrances[i].month, 
                        monthname: this.rotations.entrances[i].monthname,
                        entrances: this.rotations.entrances[i].entrances,
                        exits: 0,
                    });
                }
                let found_index;

                for (var i = 0; i < this.rotations.exits.length; i++) {
                    let currentObject = this.rotations.exits[i];
                    let found = this.merged_array.find(function(object, index, array) {
                        found_index = index;
                        return object.month == currentObject.month;
                        // console.log(object, index, array)
                    });

                    if (found) {
                        this.merged_array[found_index].exits = currentObject.exits;
                    } else {
                        this.merged_array.push({
                            year: this.rotations.exits[i].year, 
                            month: this.rotations.exits[i].month, 
                            monthname: this.rotations.exits[i].monthname,
                            entrances: 0,
                            exits: this.rotations.exits[i].exits,
                        });
                    }

                    // this.merged_array.sort(function(a,b){
                    //     return a.month - b.month;
                    // })
                        
                }
            },

            setLabels() {
                for (var i = 0; i < this.merged_array.length; i++) {
                    this.labels.push(this.merged_array[i].monthname)
                    this.entrancesData.push(this.merged_array[i].entrances);
                    this.exitsData.push(this.merged_array[i].exits);
                }
            },

        },

        mounted() {
            this.setMergedArray();
            this.setLabels();

            let ctx = document.getElementById("myChart").getContext('2d');
            let vm = this;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: vm.labels,
                    datasets: [{
                        label: 'Entrances By Month',
                        data: vm.entrancesData,
                        fill:false, 
                        borderColor: "rgba(0, 103, 84, 1)",
                        backgroundColor: "rgba(0, 103, 84, 0.4)",
                    },
                    {
                        label: 'Exits By Month',
                        data: vm.exitsData,
                        fill:false, 
                        borderColor: "rgba(153, 69, 12, 1)",
                        backgroundColor: "rgba(153, 69, 12, 0.4)",
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            stacked: true
                        }]
                    },
                    tooltips: {
                        mode: 'x'
                    },
                    legend: {
                        display: false,
                    }
                }
            });
        }


    };
</script>

<style lang="css" scoped>
</style>