
    import { Line } from 'vue-chartjs'

    export default {
        props: {
            labels: {type: Array, default: () => []},
            datasets: {},
            options: { type: Object},
            goal: {type: Number, default: null}
        },
        extends: Line,
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
