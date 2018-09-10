<template>
    <div>
        Pagination links here
    </div>    
</template>

<script>
    export default {
        name: "Paginator",
        data() {
            return {
                current_page: 1,
                first_page_url : "",
                from : 1,
                last_page : 1,
                last_page_url : "",
                next_page_url : null,
                path : "https://dainsys.test/api/positions" ,
                per_page : 50,
                prev_page_url : null,
                to : 2,
                total : 2,
            }
        }
    }
</script>

<style lang="css" scoped>

</style>