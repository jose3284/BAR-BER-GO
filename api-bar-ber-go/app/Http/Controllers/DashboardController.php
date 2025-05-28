<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\RoleDataService;
use App\Services\RoleService;

class DashboardController extends Controller
{
    protected $dataService;
    protected $roleService;

    public function __construct(RoleDataService $dataService, RoleService $roleService)
    {
        $this->dataService = $dataService;
        $this->roleService = $roleService;
    }

    public function index(Request $request)
    {
        $user = Session::get('user');

        if (!$user) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        $role = $this->roleService->mapRoleIdToName($user['id_roles']);
        $data = $this->dataService->getDataForRole($role);

        return response()->json([
            'user' => $user,
            'role' => $role,
            'data' => $data,
        ]);
    }
}
