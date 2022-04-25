<?php
namespace App\Repositories\Contracts;

interface ICriteria {

    public function withCriteria(...$criteria);
    
}
