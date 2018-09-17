<template>
    <div>
        <doughnut-chart :labels="labels" :datasets="datasets" :options="options" :height="200"></doughnut-chart>
    </div>
</template>
<script>    
    import DoughnutChart from './../../charts/DoughnutChart'
    export default {
        data() {
            return {
                datasets: [
                    { label: "Users Activities", data: [8, 15, 7, 4, 9], backgroundColor: [
                        "rgba(150, 45, 25, 1)", 
                        "rgba(30, 200, 90, 1)",
                        "rgba(200, 35, 150, 1)",
                    ] }
                ], 
                labels: ["Jan", "Feb", "Mar", "Apr", "May"],
                options: {legend: {display: false}}
            }
        },
        components: {
            DoughnutChart
        }
    }
</script>