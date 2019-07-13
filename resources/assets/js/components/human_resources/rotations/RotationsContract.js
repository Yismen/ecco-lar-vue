import DoughnutChart from '../../charts/DoughnutChart'

export default {
    data() {
        return {
            labels: ["Hires", "Terminations"],
            options: {
                label: {display: true},
                legend: {display: false},
                title: {
                    display: true,
                    text: ''
                },
                tooltips: {
                    mode: 'index',
                    intersect: true
                }
            },
            datasets: [ {
                label: "Rotations This Month",
                data: [],
                backgroundColor: [
                    "rgba(38,166,154 ,1)",
                    "rgba(244,67,54 ,1)",
                ]
            }],
        }
    },
    props: {
        hires: {required: true, type: Number},
        terminations: {required: true, type: Number},
        site: {default: ''},
    },

    computed: {
        computedDatasets() {
            this.datasets[0].data = []

            this.datasets[0].data = [
                this.hires,
                this.terminations
            ]

            return this.datasets = this.datasets
        },

        computedOptions() {
            this.options.title.text = this.defaultTitle
            return this.options
        }
    },
    components: {
        DoughnutChart
    }
}
