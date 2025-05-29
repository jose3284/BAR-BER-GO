<?php

namespace App\Services\Cita\Interfaces;

interface CitaServiceInterface
{
    public function getAll();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getEstadisticas();
}
