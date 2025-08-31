<?php

use Illuminate\Support\Facades\Auth;


if (!function_exists('hasAdminPermission')) {
    function hasAdminPermission($permission = null)
    {
        if (in_array($permission, Auth::guard('admin')->user()->role?->permissions)) {
            return true;
        }
        return false;
    }
}
