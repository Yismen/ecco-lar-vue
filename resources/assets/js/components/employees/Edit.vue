<template>
    <div>
        <div role="tabpanel" class="nav-tabs-custom">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" :class="{'active': selectedTab == '#info-employee'}">
                    <a href="#info-employee" aria-controls="info-employee" role="tab" data-toggle="tab" @click="setTab">Edit</a>
                </li>
                <li role="presentation" :class="{'active': selectedTab == '#termination'}" >
                    <a href="#termination" aria-controls="termination" role="tab" data-toggle="tab" @click="setTab">Termination</a>
                </li>
                <li role="presentation" :class="{'active': selectedTab == '#address'}" >
                    <a href="#address" aria-controls="address" role="tab" data-toggle="tab" @click="setTab">Address</a>
                </li>
                <li role="presentation" :class="{'active': selectedTab == '#photo'}" >
                    <a href="#photo" aria-controls="photo" role="tab" data-toggle="tab" @click="setTab">Photo</a>
                </li>
                <li role="presentation" :class="{'active': selectedTab == '#card_and_punch'}" >
                    <a href="#card_and_punch" aria-controls="card_and_punch" role="tab" data-toggle="tab" @click="setTab">Card and Punch</a>
                </li>
                <li role="presentation" :class="{'active': selectedTab == '#tss'}" >
                    <a href="#tss" aria-controls="tss" role="tab" data-toggle="tab" @click="setTab">TSS</a>
                </li>
                <li role="presentation" :class="{'active': selectedTab == '#login-names'}" >
                    <a href="#login-names" aria-controls="login-names" role="tab" data-toggle="tab" @click="setTab">Logins</a>
                </li>
                <li role="presentation" :class="{'active': selectedTab == '#bank_account'}" >
                    <a href="#bank_account" aria-controls="bank_account" role="tab" data-toggle="tab" @click="setTab">Bank Account</a>
                </li>
                <li role="presentation" :class="{'active': selectedTab == '#others'}" >
                    <a href="#others" aria-controls="others" role="tab" data-toggle="tab" @click="setTab">Others</a>
                </li>
                <li class="pull-right">
                    <a href="/admin/employees" title="Back to List"><i class="fa fa-home"></i> Home</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="info-employee">
                    <employee-info :employee="employee"></employee-info>
                </div>
                <div role="tabpanel" class="tab-pane" id="termination">
                    <employee-termination :employee="employee" @employee-reactivated="updateHireDate"></employee-termination>
                </div>
                <div role="tabpanel" class="tab-pane" id="address">
                    <employee-address></employee-address>
                </div>
                <div role="tabpanel" class="tab-pane" id="photo">
                    <employee-photo :employee="employee"></employee-photo>
                </div>
                <div role="tabpanel" class="tab-pane" id="card_and_punch">
                    <div class="row">
                        <div class="col-sm-6">
                            <employee-card :employee="employee"></employee-card>
                        </div>
                        <div class="col-sm-6">
                            <employee-punch :employee="employee"></employee-punch>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tss">
                    <div class="row">
                        <div class="col-sm-6">
                            <employee-ars :employee="employee"></employee-ars>
                        </div>
                        <div class="col-sm-6">
                            <employee-afp :employee="employee"></employee-afp>
                        </div>
                        <div class="col-sm-6">
                            <employee-social-security :employee="employee"></employee-social-security>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="login-names">
                    <employee-login-names :employee="employee"></employee-login-names>
                </div>
                <div role="tabpanel" class="tab-pane" id="bank_account">
                    <employee-bank-account :employee="employee"></employee-bank-account>
                </div>
                <div role="tabpanel" class="tab-pane" id="others">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <employee-nationality :employee="employee"></employee-nationality>
                            </div>
                            <div class="col-sm-6">
                                <employee-supervisor :employee="employee"></employee-supervisor>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    // import Store from '.../../store'
    import EmployeeAddress from './AddressComponent';
    import EmployeeAfp from './AFPComponent';
    import EmployeeArs from './ARSComponent';
    import EmployeeBankAccount from './BankAccountComponent';
    import EmployeeCard from './CardComponent';
    import EmployeeInfo from './InfoComponent';
    import EmployeeLoginNames from './LoginNamesComponent';
    import EmployeeNationality from './NationalityComponent';
    import EmployeePhoto from './PhotoComponent';
    import EmployeePunch from './PunchComponent';
    import EmployeeReactivation from './ReactivationComponent';
    import EmployeeSocialSecurity from './SocialSecurityComponent';
    import EmployeeSupervisor from './SupervisorComponent';
    import EmployeeTermination from './TerminationComponent';
    export default {
        name: "EmployeeIndex",
        props: ['employee'],
        data() {
            return {
                selectedTab: "#info-employee",
            }
        },
        components: {
            EmployeeAddress, EmployeeAfp, EmployeeArs, EmployeeBankAccount, EmployeeCard, EmployeeInfo, EmployeeLoginNames, EmployeeNationality, EmployeePhoto, EmployeePunch, EmployeeReactivation, EmployeeSocialSecurity, EmployeeSupervisor, EmployeeTermination
        },

        created() {
                this.$store.dispatch("employee/set", this.employee)
        },

        methods: {
            setTab(e) {
                this.selectedTab = e.target.hash
            },

            updateHireDate(employee) {
                return this.employee.hire_date = employee.hire_date
            }
        }
    }
</script>

<style lang="css" scoped>

</style>