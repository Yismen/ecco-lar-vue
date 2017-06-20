<?php

namespace App\Repositories\HumanResources;

use App\Employee;

class Issues
{
    public static function render()
    {
        return [
            'missing_address'         => self::missingAddressCount(),
            'missing_punch'           => self::missingPunchCount(),
            'missing_photo'           => self::missingPhotoCount(),
            'missing_ars'             => self::missingArsCount(),
            'missing_afp'             => self::missingAfpCount(),
            'missing_social_security' => self::missingSocialSecurityCount(),
            'missing_bank_account'    => self::missingBankAccountCount(),
        ];
    }

    protected static function getActivesCount()
    {
        return Employee::actives()->count();
    }

    protected static function getInactivesCount()
    {
        return Employee::inactives()->count();
    }

    protected static function missingAddressCount()
    {
        return Employee::has('addresses', false)->actives()->count();
    }

    protected static function missingPunchCount()
    {
        return Employee::has('punch', false)->actives()->count();
    }

    protected static function missingPhotoCount()
    {
        return Employee::where('photo', '=', '')->actives()->count();
    } 

    protected static function missingArsCount()
    {
        return Employee::has('ars', false)->actives()->count();
    }

    protected static function missingAfpCount()
    {
        return Employee::has('afp', false)->actives()->count();
    }
    
    protected static function missingSocialSecurityCount()
    {
        return Employee::has('socialSecurity', false)->actives()->count();
    }
    
    protected static function missingBankAccountCount()
    {
        return Employee::has('bankAccount', false)->actives()->count();
    }

}
