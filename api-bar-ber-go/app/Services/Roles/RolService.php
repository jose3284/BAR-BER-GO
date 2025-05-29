<?php

namespace App\Services\Roles;

use App\Models\Rol;

class RolService
{
    public function getAll()
    {
        return Rol::all();
    }

    public function find($id)
    {
        return Rol::find($id);
    }

    public function create(array $data)
    {
        return Rol::create($data);
    }

    public function update($id, array $data)
    {
        $rol = Rol::find($id);
        if (!$rol) {
            return null;
        }

        $rol->update($data);
        return $rol;
    }

    public function delete($id)
    {
        $rol = Rol::find($id);
        if (!$rol) {
            return false;
        }

        return $rol->delete();
    }
}
