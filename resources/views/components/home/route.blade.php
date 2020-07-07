&lt;?php

 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Route;

 Route::get('/entities/', 'EntityController@index');
