export default class Payroll {
    constructor (data, options = {}) {
        this.default = Object.assign({
        }, options);

        this.data = {
            employee_id: data.employee_id,
            full_name: data.full_name,
            salary_composition: data.name_and_department,
            salary: data.salary,
            pay_per_hours: data.pay_per_hours,
            hours: this.getHours()
        }
    }

    getHours() {
        
    }
}