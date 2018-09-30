
import { Doughnut } from 'vue-chartjs'

export default {
    props: {
        labels: { type: Array, default: () => ["Jan", "Feb", "Mar"] },
        datasets: { type: Array, default: () => [{ label: "Users Activities", data: [450, 325, 380], backgroundColor: "rgba(10, 8, 3, .5)" }] },
        options: { type: Object }
    },
    extends: Doughnut,
    data() {
        return {
            colors: []
        }
    },
    watch: {
        datasets: () => {
            console.log(this)
            // this.render()
            
        }
    },
    mounted() {
    },
    methods: {
        defaultOptions() {
            return Object.assign({ responsive: true, maintainAspectRatio: false }, this.options)
        },
        render() {
            this.renderChart({
                labels: this.labels,
                datasets: this.datasets
            }, this.defaultOptions());
        }
    }
}