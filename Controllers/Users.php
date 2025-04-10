<?php


require_once "Models/User.php";
class Users{

    public function main(){}

    public function userRolCreate(){
        $rol = new User;
        $rol->setId_roles(5);
        $rol->setNombreRol("administrador");
        $rol->createRol();
    }

    public function userRolRead(){
        $roles = new User;
        $roles = $roles->readRoles();
    }

    public function userRolUpdate(){
        $rolId = new User;
        $rolId = $rolId->getRolById(5);
        
        $rolUp = new User;
        $rolUp->setId_roles($rolId->getId_roles());
        $rolUp->setNombreRol("admin");
        $rolUp->updateRol();
    }

    public function userRolDelete(){
        $rolDel = new User;
        $rolDel->deleteRol(5);
    }

    public function userCreate() {
        $user = new User;
        $user->setNombre("jose");
        $user->setP_apellido("perez");
        $user->setS_apellido("rojas");
        $user->setContraseña("123456789");  
        $user->setCorreo("Juanito.Perez@gmail.com");
        $user->setId_roles(1);
        $user->setUserState(0); 
    
        $user->createUser();
    }
    
    public function userRead(){
        $user = new User;
        $user = $user->readUsers();
    }

  
    
    public function userUpdate() {
        try {
            // Obtener el código del usuario desde la URL
            if (!isset($_GET['userCode'])) {
                throw new Exception("❌ Error: No se proporcionó el código de usuario.");
            }
    
            $userCode = $_GET['userCode'];
    
            // Obtener el usuario de la base de datos
            $userModel = new User();  
            $user = $userModel->getUserById($userCode);
    
            // Verificar si el usuario existe
            if (!$user) {
                throw new Exception("❌ Error: Usuario no encontrado con ID $userCode.");
            }
    
            // Actualizar datos del usuario
            $user->setNombre("Jose");
            $user->setP_apellido("Perez");
            $user->updateUser();  
    
            echo "✅ Usuario actualizado correctamente.";
    
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function userDelete(){
        $userDel = new User;
        $userDel->deleteUser("13");
    }
}

?>


