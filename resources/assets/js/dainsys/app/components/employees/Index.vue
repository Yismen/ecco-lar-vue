<template>
    <div>
        <div role="tabpanel" class="nav-tabs-custom">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">Edit</a>
                </li>
                <li role="presentation">
                    <a href="#termination" aria-controls="termination" role="tab" data-toggle="tab">Termination</a>
                </li>
                <li role="presentation">
                    <a href="#address" aria-controls="address" role="tab" data-toggle="tab">Address</a>
                </li>
                <li role="presentation">
                    <a href="#photo" aria-controls="photo" role="tab" data-toggle="tab">Photo</a>
                </li>
                <li role="presentation">
                    <a href="#card_and_punch" aria-controls="card_and_punch" role="tab" data-toggle="tab">Card and Punch</a>
                </li>
                <li role="presentation">
                    <a href="#tss" aria-controls="tss" role="tab" data-toggle="tab">TSS</a>
                </li>
                <li role="presentation">
                    <a href="#logins" aria-controls="logins" role="tab" data-toggle="tab">Logins</a>
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
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="edit">
                    <employee-edit :employee="employee"></employee-edit>
                </div>
                <div role="tabpanel" class="tab-pane" id="termination">
                    <employee-termination :employee="employee"></employee-termination>
                </div>
                <div role="tabpanel" class="tab-pane" id="address">
                    <employee-address :employee="employee"></employee-address>
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
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="logins">
                    <employee-logins :employee="employee"></employee-logins>
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
                                <employee-social-security :employee="employee"></employee-social-security>
                            </div>
                        </div>
                        <div class="row">
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
    import EmployeeAddress from './AddressComponent';
    import EmployeeAfp from './AfpComponent';
    import EmployeeArs from './ArsComponent';
    import EmployeeBankAccount from './BankAccountComponent';
    import EmployeeCard from './CardComponent';
    import EmployeeEdit from './EditComponent';
    import EmployeeLogins from './LoginsComponent';
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
            EmployeeAddress, EmployeeAfp, EmployeeArs, EmployeeBankAccount, EmployeeCard, EmployeeEdit, EmployeeLogins, EmployeeNationality, EmployeePhoto, EmployeePunch, EmployeeReactivation, EmployeeSocialSecurity, EmployeeSupervisor, EmployeeTermination
        }
    }
</script>

<style lang="css" scoped>

</style>
