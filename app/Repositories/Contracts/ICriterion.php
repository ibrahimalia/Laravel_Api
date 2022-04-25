<?php
namespace App\Repositories\Contracts;

interface ICriterion {

    public function apply($model);

}
