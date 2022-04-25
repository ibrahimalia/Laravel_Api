<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Http\Resources\DesignResourse;
use App\Models\Design;
use App\Repositories\Contracts\IDesign;
use App\Repositories\Eloquent\Criteria\LatestFirst;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    protected $design;
    public function __construct(IDesign $design){
         $this->design = $design;
    }
    //
    public function index(){
       $designs= $this->design->withCriteria([new LatestFirst()])->all();
       return DesignResourse::collection($designs);
    }
}
