<?php

namespace App\Services;

use App\Repositories\CitaRepository;

class RoleDataService
{
    protected $citaRepository;

    public function __construct(CitaRepository $citaRepository)
    {
        $this->citaRepository = $citaRepository;
    }

    public function getDataForRole(string $role): array
    {
        if ($role === 'barbero') {
            return [
                'citas' => $this->citaRepository->getAllCitas()
            ];
        }

        return [];
    }
}
