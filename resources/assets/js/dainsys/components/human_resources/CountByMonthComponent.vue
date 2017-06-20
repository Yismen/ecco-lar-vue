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
            setInData() {
                for (var i = 0; i < this.data.in.length; i++) {
                    this.labels.push(this.data.in[i].monthname)
                    this.inData.push(this.data.in[i].count);
                }
            },

            setOutData() {
                for (var i = 0; i < this.data.out.length; i++) {
                    // if (this.labels.indexOf(this.data.out[i].monthname) == -1) {
                    //     this.labels.push(this.data.out[i].monthname)
                    // }
                    this.outData.push(this.data.out[i].count);
                }
            }
        },

        mounted() {
            this.setInData();
            this.setOutData();

            console.log(this.labels)

            let ctx = document.getElementById("myChart").getContext('2d');
            let vm = this;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: vm.labels,
                    datasets: [{
                        label: 'Entrances By Month',
                        data: vm.inData,
                        backgroundColor: "rgba(0, 103, 84, 0.5)",
                    },
                    {
                        label: 'Exits By Month',
                        data: vm.outData,
                        backgroundColor: "rgba(153, 69, 12, 0.5)",
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