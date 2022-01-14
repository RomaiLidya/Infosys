<?php

namespace App\Hady\Repository;


class Config 
{
    public static function getCompanyDetail()
    {
        $companyDetail = [
            'name'  => 'CV. Bangun Sarana Indah',
            'address_1' => 'Jl. Nginden Instan Timur V Kav. 26 No 1A
                            Surabaya, Jawa Timur, 60118',
            'phone'     => ['(+6231) - 5910733', '(+6231) - 5910735'],
            'fax'       => '(+6231) - 5910734',
            'email'     => 'admin@bsi.com'
        ];

        return $companyDetail;
    }
}