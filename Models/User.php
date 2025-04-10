<?php
require_once __DIR__ . '/Database.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Ajusta la ruta si es diferente

class User {
    private $dbh;
    private $id_roles;
    private $nombre_rol;
    private $idUsuario;
    private $Nombre;
    private $P_apellido;
    private $S_apellido;
    private $Contraseña;
    private $Correo;
    private $user_state;

    public function __construct() {
        try {
            $this->dbh = DataBase::connection();                
            $args = func_get_args();
            $num = func_num_args();
            if (method_exists($this, $f = '__construct' . $num)) {
                call_user_func_array([$this, $f], $args);
            }
        } catch (Exception $e) {
            die("❌ Constructor error: " . $e->getMessage());
        }
    }

    public function __construct0() {}

    public function __construct2($Correo, $Contraseña) {
        $this->Correo = $Correo;
        $this->Contraseña = $Contraseña;
    }

    public function __construct8($id_roles, $idUsuario, $Nombre, $P_apellido, $S_apellido, $Contraseña, $Correo, $user_state) {
        $this->id_roles = $id_roles;
        $this->idUsuario = $idUsuario;
        $this->Nombre = $Nombre;
        $this->P_apellido = $P_apellido;
        $this->S_apellido = $S_apellido;
        $this->Contraseña = $Contraseña;
        $this->Correo = $Correo;
        $this->user_state = $user_state;
    }

    public function __construct9($id_roles, $nombre_rol, $idUsuario, $Nombre, $P_apellido, $S_apellido, $Contraseña, $Correo, $user_state) {
        $this->id_roles = $id_roles;
        $this->nombre_rol = $nombre_rol;
        $this->idUsuario = $idUsuario;
        $this->Nombre = $Nombre;
        $this->P_apellido = $P_apellido;
        $this->S_apellido = $S_apellido;
        $this->Contraseña = $Contraseña;
        $this->Correo = $Correo;
        $this->user_state = $user_state;
    }

    // Métodos setter y getter        

    # Código del Rol
    public function setId_roles($id_roles){
        $this->id_roles = $id_roles;
    }
    public function getId_roles(){
        return $this->id_roles;
    }

    # Nombre del Rol
    public function setNombreRol($nombre_rol){
        $this->nombre_rol = $nombre_rol;
    }
    public function getNombreRol(){
        return $this->nombre_rol;
    }
    # Código del Usuario
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    public function getIdUsuario(){
        return $this->idUsuario;
    }
    # Nombre del Usuario
    public function setNombre($Nombre){
        $this->Nombre = $Nombre;
    }
    public function getNombre(){
        return $this->Nombre;
    }
    # Apellido del Usuario
    public function setP_apellido($P_apellido){
        $this->P_apellido = $P_apellido;
    }
    public function getP_apellido(){
        return $this->P_apellido;
    }
    # Identificación del Usuario
    public function setS_apellido($S_apellido){
        $this->S_apellido = $S_apellido;
    }
    public function getS_apellido(){
        return $this->S_apellido;
    }
    # Email del Usuario
    public function setContraseña($Contraseña){
        $this->Contraseña = $Contraseña;
    }
    public function getContraseña(){
        return $this->Contraseña;
    }
    # Contraseña del Usuario
    public function setCorreo($Correo){
        $this->Correo = $Correo;
    }
    public function getCorreo(){
        return $this->Correo;
    }
    # Estado del Usuario
    public function setUserState($user_state){
        $this->user_state = $user_state;
    }
    public function getUserState(){
        return $this->user_state;
    }
    public function login() {
        try {
            $sql = 'SELECT * FROM usuarios WHERE Correo = :Correo';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue(':Correo', $this->getCorreo());
            $stmt->execute();
            $userDb = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userDb && password_verify($this->getContraseña(), $userDb['Pass'])) {
                $user = new User(
                    $userDb['id_roles'],
                    $userDb['idUsuario'],
                    $userDb['Nombre'],
                    $userDb['P_apellido'],
                    $userDb['S_apellido'],
                    $userDb['Pass'], // Contraseña hasheada
                    $userDb['Correo'],
                    $userDb['userState']
                );
                unset($user->dbh);
                return $user;
            }
            return false;
        } catch (Exception $e) {
            die("❌ Error en login(): " . $e->getMessage());
        }
    }
  
    # Recuperar contraseña 
    public function requestPasswordReset($Correo) {
        try {
            // Verifica que exista el usuario
            $sql = "SELECT * FROM usuarios WHERE Correo = :Correo LIMIT 1";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue(':Correo', $Correo);
            $stmt->execute();
            $userDb = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$userDb) return false;
    
            // Genera el token
            $token = md5($Correo . time() . rand());
    
            // Guarda token y expiración
            $sqlUpdate = "UPDATE usuarios SET reset_token = :token, reset_expiration = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE idUsuario = :idUsuario";
            $stmtUpdate = $this->dbh->prepare($sqlUpdate);
            $stmtUpdate->bindValue(':token', $token);
            $stmtUpdate->bindValue(':idUsuario', $userDb['idUsuario']);
            $stmtUpdate->execute();
    
            // Envía el correo
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'b8356103@gmail.com'; // Tu correo real
            $mail->Password = 'tzwd apsr clbv fksg'; // Contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
            $mail->setFrom('b8356103@gmail.com', 'Soporte Técnico');
            $mail->addAddress($Correo);
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body = "
                Hola, haz clic en el siguiente enlace para restablecer tu contraseña:<br>
                <a href='http://localhost/BackEnd/Public/resetpassword.php?token=$token'>Recuperar contraseña</a><br><br>
                Este enlace expirará en 1 hora.
            ";
    
            $mail->send();
    
            return true;
    
        } catch (Exception $e) {
            return "Error al enviar correo: " . $mail->ErrorInfo;
        }
    }
    
    # actualizar contraseña 

    public function resetPassword($token, $newPassword) {
        try {
            $sql = "SELECT * FROM usuarios WHERE reset_token = :token AND reset_expiration > NOW() LIMIT 1";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue(':token', $token);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$user) {
                return "Token inválido o expirado.";
            }
    
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sqlUpdate = "UPDATE usuarios SET Pass = :Pass, reset_token = NULL, reset_expiration = NULL WHERE idUsuario = :id";
            $stmtUpdate = $this->dbh->prepare($sqlUpdate);
            $stmtUpdate->bindValue(':Pass', $hashedPassword);
            $stmtUpdate->bindValue(':id', $user['idUsuario']);
            $stmtUpdate->execute();
    
            return true;
    
        } catch (Exception $e) {
            return "Error al actualizar la contraseña: " . $e->getMessage();
        }
    }
    
    
    # CU04 - Registrar Rol
    public function createRol(){
        try {
            $sql = 'INSERT INTO roles VALUES (:id_roles,:nombre_rol)';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('id_roles', $this->getId_roles());
            $stmt->bindValue('nombre_rol', $this->getNombreRol());
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    # RF05_CU05 - Consultar Roles
    public function readRoles(){
        try {
            $rolList = [];
            $sql = 'SELECT * FROM roles';
            $stmt = $this->dbh->query($sql);
            foreach ($stmt->fetchAll() as $rol) {
                $rolObj = new User;
                $rolObj->setId_roles($rol['id_roles']);
                $rolObj->setNombreRol($rol['nombre_rol']);
                array_push($rolList, $rolObj);
            }
            return $rolList;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    # RF06_CU06 - Obtener el Rol por el código
    public function getRolById($id_roles){
        try {
            $sql = "SELECT * FROM roles WHERE id_roles=:Id_roles";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('Id_roles', $id_roles);
            $stmt->execute();
            $rolDb = $stmt->fetch();
            $rol = new User;
            $rol->setId_roles($rolDb['id_roles']);
            $rol->setNombreRol($rolDb['nombre_rol']);
            return $rol;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    # RF07_CU07 - Actualizar Rol
    public function updateRol(){
        try {
            $sql = 'UPDATE roles SET
                        id_roles = :Id_roles,
                        nombre_rol = :NombreRol
                    WHERE id_roles = :Id_roles';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('Id_roles', $this->getId_roles());
            $stmt->bindValue('NombreRol', $this->getNombreRol());
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    # RF08_CU08 - Eliminar Rol
    public function deleteRol($id_roles){
        try {
            $sql = 'DELETE FROM roles WHERE id_roles = :Id_roles';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('Id_roles', $id_roles);
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    # CU08 - Registrar Usuario
    public function createUser() {
        try {
            $sql = 'INSERT INTO usuarios (Nombre, P_apellido, S_apellido, Pass, Correo, id_roles, userState) 
                    VALUES (:Nombre, :P_apellido, :S_apellido, :Pass, :Correo, :id_roles, :userState)';
    
            $stmt = $this->dbh->prepare($sql);
    
            // Hashear la contraseña antes de ejecutarlo
            $hashedPassword = password_hash($this->getContraseña(), PASSWORD_BCRYPT);
    
            // Ejecutar la consulta con un array de parámetros
            $success = $stmt->execute([
                ':Nombre' => $this->getNombre(),
                ':P_apellido' => $this->getP_apellido(),
                ':S_apellido' => $this->getS_apellido(),
                ':Pass' => $hashedPassword,
                ':Correo' => $this->getCorreo(),
                ':id_roles' => $this->getId_roles(),
                ':userState' => (int) $this->getUserState()
            ]);
    
            if ($success) {
                echo "✅ Usuario creado correctamente.";
            } else {
                echo "❌ Error al crear usuario.";
            }
        } catch (PDOException $e) {
            die("❌ Error en createUser(): " . $e->getMessage());
        }
    }
    
    
    
     # RF05_CU08 - Consultar Usuarios
     public function readUsers(){
        try {
            $userList = [];
            $sql = 'SELECT * FROM usuarios';
            $stmt = $this->dbh->query($sql);
            foreach ($stmt->fetchAll() as $user) {
                $userObj = new User(
                    $user['id_roles'],                        
                    $user['idUsuario'],
                    $user['Nombre'],
                    $user['P_apellido'],
                    $user['S_apellido'],
                    $user['Pass'],
                    $user['Correo'],
                    $user['userState'],
                );
                array_push($userList, $userObj);
            }
            return $userList;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    # RF06_CU06 - Obtener el Rol por el código
    public function getUserById($idUsuario) {
        try {
            $sql = "SELECT * FROM USUARIOS WHERE idUsuario = :IdUsuario";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue(':IdUsuario', $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            
            $userDb = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Verificar si se encontró el usuario
            if (!$userDb) {
                return null; // O lanzar una excepción si prefieres
            }
    
            $user = new User(
                $userDb['idUsuario'],
                $userDb['Nombre'],
                $userDb['P_apellido'],
                $userDb['S_apellido'],
                $userDb['Pass'],  
                $userDb['Correo'],
                $userDb['id_roles'],
                $userDb['userState'] // En tu tabla se llama `userState`, no `user_state`
            );
    
            return $user;
    
        } catch (PDOException $e) {
            die("❌ Error en getUserById(): " . $e->getMessage());
        }
    }
    

    # RF07_CU07 - Actualizar Usuario
    public function updateUser() {
        try {
            $sql = 'UPDATE usuarios SET
                        id_roles = :id_roles,
                        Nombre = :Nombre,
                        P_apellido = :P_apellido,
                        S_apellido = :S_apellido,
                        Pass = :Pass,
                        Correo = :Correo,
                        userState = :userState
                    WHERE idUsuario = :idUsuario';
    
            $stmt = $this->dbh->prepare($sql);
    
            // Asegurar que los nombres de los parámetros coincidan con la base de datos
            $stmt->bindValue(':id_roles', $this->getId_roles(), PDO::PARAM_INT);
            $stmt->bindValue(':Nombre', $this->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(':P_apellido', $this->getP_apellido(), PDO::PARAM_STR);
            $stmt->bindValue(':S_apellido', $this->getS_apellido(), PDO::PARAM_STR);
            $stmt->bindValue(':Pass', password_hash($this->getContraseña(), PASSWORD_BCRYPT), PDO::PARAM_STR); // Se hashea la contraseña
            $stmt->bindValue(':Correo', $this->getCorreo(), PDO::PARAM_STR);
            $stmt->bindValue(':userState', $this->getUserState(), PDO::PARAM_INT);
            $stmt->bindValue(':idUsuario', $this->getIdUsuario(), PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                echo "✅ Usuario actualizado correctamente.";
            } else {
                echo "❌ Error al actualizar usuario.";
            }
        } catch (Exception $e) {
            die("❌ Error en updateUser(): " . $e->getMessage());
        }
    }
    

    # RF08_CU08 - Eliminar Usuario
    public function deleteUser($idUsuario){
        try {
            $sql = 'DELETE FROM usuarios WHERE idUsuario = :IdUsuario';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('IdUsuario', $idUsuario);
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



}


?>