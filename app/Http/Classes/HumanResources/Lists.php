<?php 

namespace App\Http\Classes\HumanResources;

use App\Employee;

class Lists
{

    public static function render()
    {

    }

    private static function scope()
    {
        return Employee::actives()
            ->with('position.department');
    }

    public static function missingArs()
    {
        return self::scope()->has('ars', false);
    }

    public static function missingAfp()
    {
        return self::scope()->has('afp', false);
    }

    public static function missingAddress()
    {
        return self::scope()->has('addresses', false);
    }

    public static function missingPunch()
    {
        return self::scope()->has('punch', false);
    }

    public static function missingPhoto()
    {
        return self::scope()->where('photo', '');
    }

    public static function missingSocialSecurity()
    {
        return self::scope()->has('socialSecurity', false);
    }

    public static function missingBankAccount()
    {
        return self::scope()->has('bankAccount', false);
    }
}