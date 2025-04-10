<?php
require_once("../Models/CitaAPI.php");

class CitaController {
    private $api;

    public function __construct() {
        $this->api = new CitaAPI();
    }

    public function mostrarCitas() {
        return $this->api->getAll();
    }

    public function guardarCita($datos) {
        return $this->api->create($datos);
    }

    public function obtenerCitaPorId($id) {
        return $this->api->getById($id);
    }

    public function actualizarCita($id, $datos) {
        return $this->api->update($id, $datos);
    }

    public function eliminarCita($id) {
        return $this->api->delete($id);
    }
}
