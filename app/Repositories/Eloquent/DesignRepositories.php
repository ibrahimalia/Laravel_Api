<?php
namespace App\Repositories\Eloquent;

use App\Models\Design;
use App\Repositories\Contracts\IDesign;

class DesignRepositories extends BaseRepositories implements IDesign{

   public function model(){
       return Design::class;
   }

}
