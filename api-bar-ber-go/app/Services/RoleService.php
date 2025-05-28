<?php

namespace App\Services;

class RoleService
{
    protected $rolesMap = [
        1 => 'admin',
        2 => 'barbero',
        3 => 'vendedor',
        4 => 'cliente',
    ];

    public function mapRoleIdToName(int $roleId): string
    {
        return $this->rolesMap[$roleId] ?? 'cliente';
    }
}
