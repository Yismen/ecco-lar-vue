<template>
    <div>        
        <modal v-model="editMode">
            <div slot="title">
                <h3>Edit Position {{ position.name_and_department }}</h3>
            </div>
            <pre>{{ position }}</pre>
            <div slot="footer">
                <btn @click="editMode=false">Cancel</btn>
                <btn type="warning" @click="updatePosition(position)">Edit Position</btn>
            </div>
        </modal>
    </div>    
</template>

<script>
    import {Modal, Btn} from 'uiv'
    export default {
        name: "Edit",
        props: ['position'],
        data() {
            return {
                editMode: false,
                position: {}                
            }
        },
        components: {
            Modal, Btn
        },
        methods: {
            editPosition(position) {
                this.editMode = true
                this.position = position
            },
            updatePosition(position) {
                this.editMode = false
                let id = position.id
                console.log(position)
                let filtered = this.positions.filter(function(value, index, array) {

                    console.log((value, index, array))
                })
            }
        }
    }
</script>

<style lang="css" scoped>

</style>