<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomerFilter extends ApiFilter{
    protected $safeParms = [
        'id' =>['eq','gt','lt','gte','lte'], 
        'name' =>['eq'],
        'type' =>['eq'],
        'email' =>['eq'],
        'address' =>['eq'],
        'city' =>['eq'],
        'state' =>['eq'],
        'postalCode' =>['eq','gt','lt'],
    ];
    protected $columnMap = [
        'postalCode ' => 'postal_code'
    ];
    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
    ];



}