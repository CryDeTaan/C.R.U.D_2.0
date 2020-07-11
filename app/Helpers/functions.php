<?php

if (!function_exists('slug_to_title')) {

    function slug_to_title($slug)
    {
        return Str::of($slug)->replace('-', ' ')->title();
    }
}

if (!function_exists('slug_to_titles')) {

    function slug_to_titles($slug)
    {
        return Str::of($slug)->replace('-', ' ')->plural()->title();
    }
}

if (!function_exists('slug_to_controller')) {

    function slug_to_controller($slug)
    {
        return Str::of(slug_to_title($slug))->replace(' ', '');
    }
}

if (!function_exists('get_role')) {

    function get_role($role)
    {
        return App\Role::whereName($role)->first();
    }
}
