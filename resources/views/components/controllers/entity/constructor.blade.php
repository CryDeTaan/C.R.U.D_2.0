&lt;?php

 namespace App\Http\Controllers;

 use App\Entity;
 use Illuminate\Http\Request;

 class EntityController extends Controller
 {
     public function __construct()
     {
         $this->middleware('auth');
         $this->authorizeResource(Entity::class, 'entity');
     }
 }
