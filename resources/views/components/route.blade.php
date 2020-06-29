&lt;?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::{{ $action }}('/{{ $uri }}/', '{{ $controller }}Controller&#64;{{ $method }}');
