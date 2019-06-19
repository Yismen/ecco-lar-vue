<template>
    <div>
        <div role="tabpanel" class="nav-tabs-custom">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#info-employee" aria-controls="info-employee" role="tab" data-toggle="tab">Edit</a>
                </li>
                <li role="presentation">
                    <a href="#termination" aria-controls="termination" role="tab" data-toggle="tab">Termination</a>
                </li>
                <li role="presentation">
                    <a href="#photo-and-address" aria-controls="photo-and-address" role="tab" data-toggle="tab">Photo and Address</a>
                </li>
                <li role="presentation">
                    <a href="#card_and_punch" aria-controls="card_and_punch" role="tab" data-toggle="tab">Card and Punch</a>
                </li>
                <li role="presentation">
                    <a href="#tss" aria-controls="tss" role="tab" data-toggle="tab">TSS</a>
                </li>
                <li role="presentation" >
                    <a href="#login-names" aria-controls="login-names" role="tab" data-toggle="tab">Logins</a>
                </li>
                <li role="presentation">
                    <a href="#bank_account" aria-controls="bank_account" role="tab" data-toggle="tab">Bank Account</a>
                </li>
                <li role="presentation">
                    <a href="#others" aria-controls="others" role="tab" data-toggle="tab">Others</a>
                </li>
                <li class="pull-right">
                    <a href="/admin/employees" title="Back to List"><i class="fa fa-home"></i> Home</a>
                </li>
            </ul>
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <h4>
                        <a :href="'/admin/employees/' + employee.id">
                            {{ employee.id }}, {{ employee.full_name }}
                        </a>
                    </h4>
                </div>
            </div>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="info-employee">
                    <EmployeeInfo />
                </div>
                <div role="tabpanel" class="tab-pane" id="termination">
                    <EmployeeTermination />
                </div>
                <div role="tabpanel" class="tab-pane" id="photo-and-address">
                    <div class="row">
                        <div class="col-sm-6">
                            <EmployeePhoto />
                        </div>

                        <div class="col-sm-6">
                            <EmployeeAddress />
                        </div>
                    </div>

                </div>

                <div role="tabpanel" class="tab-pane" id="card_and_punch">
                    <div class="row">
                        <div class="col-sm-6">
                            <EmployeeCard />
                        </div>
                        <div class="col-sm-6">
                            <EmployeePunch />
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tss">
                    <div class="row">
                        <div class="col-sm-6">
                            <EmployeeArs />
                        </div>
                        <div class="col-sm-6">
                            <EmployeeAfp />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <EmployeeSocialSecurity />
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="login-names">
                    <EmployeeLoginNames />
                </div>
                <div role="tabpanel" class="tab-pane" id="bank_account">
                    <EmployeeBankAccount />
                </div>
                <div role="tabpanel" class="tab-pane" id="others">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <EmployeeSupervisor />
                            </div>
                            <div class="col-sm-6">
                                <EmployeeNationality />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
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
        components: {
            EmployeeAddress, EmployeeAfp, EmployeeArs, EmployeeBankAccount, EmployeeCard, EmployeeInfo, EmployeeLoginNames, EmployeeNationality, EmployeePhoto, EmployeePunch, EmployeeReactivation, EmployeeSocialSecurity, EmployeeSupervisor, EmployeeTermination
        },

        created() {
            this.$store.dispatch("employee/set", this.employee)
        }
    }
</script>

<style lang="css" scoped>

</style>
