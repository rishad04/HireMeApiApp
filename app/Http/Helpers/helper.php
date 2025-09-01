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

function applicationStatus($status = '')
{
    $data = [
        "submitted" => 'Submitted',
        "accepted" => 'Accepted',
        "rejected" => 'Rejected',
        "processing" => 'Processing',
    ];

    if ($status) {
        return isset($data[$status]) ? $data[$status] : __('default.unknown');
    } else {
        return $data;
    }
}
