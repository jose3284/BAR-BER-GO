<?php
class CitaAPI {

    private $apiUrl = "http://localhost:8000/api/cita"; // Cambia si tu API está en otro puerto o dominio

    public function getAll() {
        return $this->request("GET");
    }

    public function getById($id) {
        return $this->request("GET", "/$id");
    }

    public function create($data) {
        return $this->request("POST", "", $data);
    }

    public function update($id, $data) {
        return $this->request("PUT", "/$id", $data);
    }

    public function delete($id) {
        return $this->request("DELETE", "/$id");
    }

    private function request($method, $endpoint = "", $data = null) {
        $url = $this->apiUrl . $endpoint;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($data) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $error = curl_error($ch);

        curl_close($ch);

        if ($error) {
            return ["error" => $error];
        }

        return json_decode($response, true);
    }
}
