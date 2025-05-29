<?php

namespace App\Services\Usuarios;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioService
{
    public function getAll()
    {
        return Usuario::all();
    }

    public function getById($id)
    {
        return Usuario::find($id);
    }

    public function create(array $data)
    {
        $data['Pass'] = Hash::make($data['Pass']);
        return Usuario::create($data);
    }

    public function update($id, array $data)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) return null;

        if (isset($data['Pass'])) {
            $data['Pass'] = Hash::make($data['Pass']);
        }

        $usuario->update($data);
        return $usuario;
    }

    public function delete($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) return false;

        $usuario->delete();
        return true;
    }
}
