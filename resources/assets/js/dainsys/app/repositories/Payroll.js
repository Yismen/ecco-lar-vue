const PayrolStore = {
    data: {
        payrolls: []
    },

    methods: {
        addPayroll(payroll) {
            return this.payrolls.push(payroll);
        }
    }
}