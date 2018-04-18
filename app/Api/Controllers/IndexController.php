<?php
namespace App\Api\Controllers;

use App\Config\Config;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController{

    public function index(){
        phpinfo();
    }
}