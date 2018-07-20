<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Models\CategoriesModels;
use App\Http\Models\ProductsModels;
use App\Http\Models\CommentModels;
use App\Http\Models\UsersModels;
use App\Http\Requests\UsersRequests;
use Hash;
use App\User;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

  public function index() {
     $cmts = CommentModels::get_comments();
     $data = ['cmts'=>$cmts];
     return view('admin.comments.list')->with($data);
 }



}
