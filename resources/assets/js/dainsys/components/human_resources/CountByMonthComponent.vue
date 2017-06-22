<template>
    <div class="_CounthByMonth">
        <div class="box-header with-border">
            <h4>Monthly Movements</h4>
        </div>

        <div class="box-body">
            <canvas id="myChart" width="100%" height="100px"></canvas>
        </div>
        
    </div>
</template>

<script>
    import Chart from 'chart.js';
    export default {
        name: 'CountByMonthComponent',

        data () {
            return {
                labels: [],
                merged_array: [],
                inData: [],
                outData: [],
            };
        }, 

        props: {
            'data': {
                type: Object
            }
        },

        methods: {
            setMergedArray() {           

                for (var i = 0; i < this.data.in.length; i++) {
                    this.merged_array.push({
                        year: this.data.in[i].year, 
                        month: this.data.in[i].month, 
                        monthname: this.data.in[i].monthname,
                        entrances: this.data.in[i].entrances,
                        outages: 0,
                    });
                }
                let found_index;

                for (var i = 0; i < this.data.out.length; i++) {
                    let currentObject = this.data.out[i];
                    let found = this.merged_array.find(function(object, index, array) {
                        found_index = index;
                        return object.month == currentObject.month;
                        // console.log(object, index, array)
                    });

                    if (found) {
                        this.merged_array[found_index].outages = currentObject.outages;
                    } else {
                        this.merged_array.push({
                            year: this.data.out[i].year, 
                            month: this.data.out[i].month, 
                            monthname: this.data.out[i].monthname,
                            entrances: 0,
                            outages: this.data.out[i].outages,
                        });
                    }

                    this.merged_array.sort(function(a,b){
                        return a.month - b.month;
                    })
                        
                }
            },

            setLabels() {
                for (var i = 0; i < this.merged_array.length; i++) {
                    this.labels.push(this.merged_array[i].monthname)
                    this.inData.push(this.merged_array[i].entrances);
                    this.outData.push(this.merged_array[i].outages);
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
                        data: vm.inData,
                        backgroundColor: "rgba(0, 103, 84, 0.4)",
                    },
                    {
                        label: 'Exits By Month',
                        data: vm.outData,
                        backgroundColor: "rgba(153, 69, 12, 0.4)",
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            stacked: true
                        }]
                    }
                }
            });
        }


    };
</script>

<style lang="css" scoped>
</style>