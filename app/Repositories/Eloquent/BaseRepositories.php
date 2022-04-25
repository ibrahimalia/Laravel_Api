<?php
namespace App\Repositories\Eloquent;

use App\Exceptions\ModelNotDefined;
use App\Repositories\Contracts\IBase;
use App\Repositories\Contracts\ICriteria;
use Exception;
use Illuminate\Support\Arr;

class BaseRepositories implements IBase,ICriteria{
    protected $model;
    public function __construct()
    {
       $this->model = $this->getTypeModel();
    }
    public function all(){
      return $this->model->get();
    }
    public function getTypeModel(){
        if (!method_exists($this,"model")) {
            throw new ModelNotDefined();
        }
        return app()->make($this->model());
    }

    public function withCriteria(...$criteria){
         $criteria= Arr::flatten($criteria);
         foreach ($criteria as $criterion) {
             $this->model = $criterion->apply($this->model);
         };
        return $this;
    }


}
