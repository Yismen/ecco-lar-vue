
    import { Pie } from 'vue-chartjs'

    export default {
        props: {
            labels: {
                type: Array,
                default: () => ["Jan", "Feb", "Mar"]
            },
            datasets: {
                type: Array, default: () => [
                {
                    label: "Users Activities",
                    data: [450, 325, 1500],
                    backgroundColor: [
                        "rgba(0, 166, 90, .80)",
                        "rgba(243, 156, 18, .80)",
                        "rgba(245, 15, 84, .80)",
                        "rgba(200, 35, 150, .80)",
                        "rgba(255, 195, 0, 0.8)",
                        "rgba(218, 247, 166, 0.8)",
                        "rgba(249, 235, 234, 0.8)",
                        "rgba(245, 183, 177, 0.8)",
                        "rgba(215, 189, 226, 0.8)",
                        "rgba(84, 153, 199, 0.8)",
                        "rgba(195, 155, 211, 0.8)",
                        "rgba(247, 220, 111, 0.8)",
                        "rgba(217, 136, 128, 0.8)",
                        "rgba(133, 193, 233, 0.8)",
                        "rgba(240, 178, 122, 0.8)",
                        "rgba(215, 219, 221, 0.8)",
                    ]
                }]
            },
            options: { type: Object}
        },
        extends: Pie,
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
