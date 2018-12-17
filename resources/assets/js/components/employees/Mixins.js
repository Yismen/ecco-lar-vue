export default {
    computed: {
        fullName() {
            return this.$store.getters['employee/getEmployee'].full_name
        },
        id() {
            return this.$store.getters['employee/getEmployee'].id
        }
    }
}