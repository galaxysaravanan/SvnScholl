<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\User;

class DashboardController extends Controller {
	
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function dashboard() {
       
        return view( 'admin/dashboard');
    }
    public function profile() {
       
        return view( 'admin/profile');
    }
}

