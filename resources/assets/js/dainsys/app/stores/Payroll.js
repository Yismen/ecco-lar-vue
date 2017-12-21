import Moment from 'moment';
export default {
    state: {
        payment_date: Moment()
    },
    getters: {
        today(state) {
            return state.payment_date.format('MM/DD/YY')
        }
    },

    mutations: {
        updatePaymentDate(state) {
            return state.payment_date;
        }
    }
};