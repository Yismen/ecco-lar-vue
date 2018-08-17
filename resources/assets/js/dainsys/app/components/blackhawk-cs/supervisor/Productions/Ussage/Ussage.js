export default new class Ussage {
    utilization(time_online, time_in_chats, email_sessions) {
        let transaction_time = ((email_sessions * 6 / 60) + time_in_chats);

        let utilization = time_online > 0 ?
            transaction_time / time_online * 100 :
            0;

        return utilization.toFixed(2);
    }

    efficiency(time_logged_in, time_online) {
        let efficiency = time_logged_in > 0 ?
            time_online / time_logged_in * 100 :
            0;
        return efficiency.toFixed(2);
    }
}