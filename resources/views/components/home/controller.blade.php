&lt;?php

 namespace App\Http\Controllers;

 use App\Entity;
 use Illuminate\Http\Request;

 class EntityAdminController extends Controller
 {
     public function __construct()
     {
         $this->middleware('auth');
     }

     public function index()
     {
         $entities = Entity::all();
         return view('actions.entity.read', compact('entities'));
     }
 }
