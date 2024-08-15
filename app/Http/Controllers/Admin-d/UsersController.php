<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use App\Models\User;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware( 'auth' );
    }

     public function userprofile() {

        return view("users/user_profile");
     }
    }
