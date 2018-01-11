import Moment from 'moment';
export default {
    state: {
        generated: false,
        employees: []
    },

    getters: {
        fromDate(state) {
            return  state.employees.employees_with_hours ? state.employees.employees_with_hours.from : null;
        },

        toDate(state) {
            return  state.employees.employees_with_hours ? state.employees.employees_with_hours.to : null;
        },
        isGenerated(state) {
            return state.generated;
        },
        allEmployees(state) {
           return state.employees.employees_with_hours ? state.employees.employees_with_hours.data : [];
        }
    },

    mutations: {
        payrollGenerated(state, payload) {
            state.generated = true;
            return state.employees = payload;
        }
    },

};