<?php

namespace Core\Service;

class UserRole
{
    private static $admin_user_ids = [9,55,58];

    public static function checkAdminRules($user_id) {
        $user_id = (int) $user_id;
        return in_array($user_id, self::$admin_user_ids);
    }
}