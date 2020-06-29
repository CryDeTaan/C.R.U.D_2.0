&lt;?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/entities/{entity}', 'EntityController@show');
