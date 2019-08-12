
    import { Bar } from 'vue-chartjs'

    export default {
        props: {
            labels: {type: Array, default: () => []},
            datasets: {},
            options: { type: Object},
        },
        extends: Bar,
        mounted() {
            this.renderChart({
                labels: this.labels,
                datasets: this.datasets
            }, this.defaultOptions());
        },
        methods: {
            defaultOptions() {
                return Object.assign({ responsive: true, maintainAspectRatio: false }, this.options)
            }
        }
    }
