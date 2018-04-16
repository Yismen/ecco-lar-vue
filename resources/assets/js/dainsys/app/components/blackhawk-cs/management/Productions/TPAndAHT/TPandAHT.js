export default new class TPandAHT {
    tp(records, hours) {
        let throughput = hours > 0 ?
            records / hours :
            0;

        return Number(throughput.toFixed(2));
    }

    aht(records, hours) {
        let aht = records > 0 ?
            hours * 60 / records :
            0;
        return Number(aht.toFixed(2));
    }
}