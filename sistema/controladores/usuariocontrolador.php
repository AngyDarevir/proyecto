<?php
class UsuarioModelo {
    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=xube", "root", "");
    }

    public function registrarUsuario($nombre, $apellidos, $email, $telefono, $password, $estatus, $codigo, $vigencia_Codigo, $tipo, $clave_asociado) {
        try {
            $sql = "INSERT INTO usuarios (nombre, apellidos, email, telefono, password, estatus, codigo, vigencia_Codigo, tipo, clave_Asociado) 
                    VALUES (:nombre, :apellidos, :email, :telefono, :password, :estatus, :codigo, :vigencia_Codigo, :tipo, :clave_asociado)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":apellidos", $apellidos);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":telefono", $telefono);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":estatus", $estatus);
            $stmt->bindParam(":codigo", $codigo);
            $stmt->bindParam(":vigencia_Codigo", $vigencia_Codigo);
            $stmt->bindParam(":tipo", $tipo);
            $stmt->bindParam(":clave_asociado", $clave_asociado);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en registro: " . $e->getMessage());
            return false;
        }
    }

    public function registrarPlan($nombre, $precio,$categoria, $impuestos, $vigencia, $descripcion) {
        try {
            $sql = "INSERT INTO planes (nombre, precio, descripcion, categoria, vigencia, impuestos) 
                    VALUES (:nombre, :precio, :descripcion, :categoria, :vigencia, :impuestos)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":impuestos", $impuestos);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":precio", $precio);
            $stmt->bindParam(":descripcion", $descripcion);
            $stmt->bindParam(":categoria", $categoria);
            $stmt->bindParam(":vigencia", $vigencia);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en registro: " . $e->getMessage());
            return false;
        }
    }
    
        public function obtenerUsuarios() {
            $stmt = $this->db->query("SELECT * FROM usuarios");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function borrarUsuario($id) {
            $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id_Usuario = :id_Usuario");
            return $stmt->execute(['id_Usuario' => $id]);
        }
        public function actualizarUsuario($id, $datos) {
            $stmt = $this->db->prepare("UPDATE usuarios SET nombre = :nombre, apellidos=:apellidos, telefono = :telefono, email = :email, password = :password, clave_Asociado = :clave_Asociado, tipo= :tipo  WHERE id_Usuario = :id_Usuario");
            return $stmt->execute([
                'id_Usuario' => $id,
                'nombre' => $datos['nombre'],
                'apellidos' => $datos['apellidos'],
                'telefono' => $datos['telefono'],
                'email' => $datos['email'],
                'password' => $datos['password'],
                'clave_Asociado' => $datos['clave_Asociado'],
                'tipo' => $datos['tipo']

            ]);
        }
        public function obtenerConPaginacion($tabla, $pagina = 1, $limite = 4, $busqueda = null) {
            // Validar y calcular valores de paginación
            $pagina = is_numeric($pagina) && $pagina > 0 ? (int)$pagina : 1;
            $limite = is_numeric($limite) && $limite > 0 ? (int)$limite : 4;
            $offset = ($pagina - 1) * $limite;
        
            // Verificar que la tabla existe para evitar inyecciones SQL
            if (!$this->validarTabla($tabla)) {
                throw new Exception("Tabla no válida: " . htmlspecialchars($tabla));
            }
        
            // Base de la consulta
            $where = "";
            $params = [];
        
            // Si hay una búsqueda, agregar la condición WHERE
            if ($busqueda) {
                $where = "WHERE nombre LIKE :busqueda OR email LIKE :busqueda";
                $params[':busqueda'] = "%$busqueda%";
            }
        
            // Consulta principal con límite y desplazamiento
            $sql = "SELECT * FROM $tabla $where LIMIT :limite OFFSET :offset";
            $stmt = $this->db->prepare($sql);
        
            // Enlazar parámetros
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            if ($busqueda) {
                $stmt->bindValue(':busqueda', "%$busqueda%", PDO::PARAM_STR);
            }
            $stmt->execute();
        
            $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            // Contar total de registros con búsqueda
            $sqlTotal = "SELECT COUNT(*) as total FROM $tabla $where";
            $stmtTotal = $this->db->prepare($sqlTotal);
            if ($busqueda) {
                $stmtTotal->bindValue(':busqueda', "%$busqueda%", PDO::PARAM_STR);
            }
            $stmtTotal->execute();
            $totalRegistros = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];
        
            $totalPaginas = ceil($totalRegistros / $limite);
        
            return [
                'registros' => $registros,
                'paginaActual' => $pagina,
                'totalPaginas' => $totalPaginas,
                'limite' => $limite
            ];
        }
        
        private function validarTabla($tabla) {
            $stmt = $this->db->prepare("SHOW TABLES LIKE :tabla");
            $stmt->execute(['tabla' => $tabla]);
            return $stmt->rowCount() > 0;
        }


        public function obtenerPlanes() {
            $stmt = $this->db->query("SELECT * FROM planes");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function obtenerBusquedaPlanes($pagina = 1, $limite = 4, $busqueda = null) {
            // Validar y calcular valores de paginación
            $pagina = is_numeric($pagina) && $pagina > 0 ? (int)$pagina : 1;
            $limite = is_numeric($limite) && $limite > 0 ? (int)$limite : 4;
            $offset = ($pagina - 1) * $limite;
        
            // Base de la consulta
            $where = "";
            $params = [];
        
            // Si hay una búsqueda, agregar la condición WHERE
            if ($busqueda) {
                $where = "WHERE nombre LIKE :busqueda OR categoria LIKE :busqueda OR precio LIKE :busqueda";
                $params[':busqueda'] = "%$busqueda%";
            }
        
            // Consulta principal con límite y desplazamiento
            $sql = "SELECT * FROM planes $where LIMIT :limite OFFSET :offset";
            $stmt = $this->db->prepare($sql);
        
            // Enlazar parámetros
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            if ($busqueda) {
                $stmt->bindValue(':busqueda', "%$busqueda%", PDO::PARAM_STR);
            }
            $stmt->execute();
        
            $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            // Contar total de registros con búsqueda
            $sqlTotal = "SELECT COUNT(*) as total FROM planes $where";
            $stmtTotal = $this->db->prepare($sqlTotal);
            if ($busqueda) {
                $stmtTotal->bindValue(':busqueda', "%$busqueda%", PDO::PARAM_STR);
            }
            $stmtTotal->execute();
            $totalRegistros = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];
        
            $totalPaginas = ceil($totalRegistros / $limite);
        
            return [
                'registros' => $registros,
                'paginaActual' => $pagina,
                'totalPaginas' => $totalPaginas,
                'limite' => $limite
            ];
        }
    
        public function borrarPlanes($id) {
            $stmt = $this->db->prepare("DELETE FROM planes WHERE id_Plan = :id_Plan");
            return $stmt->execute(['id_Plan' => $id]);
        }
        public function actualizarPlanes($id, $plan) {
            $stmt = $this->db->prepare("UPDATE planes SET nombre = :nombre, descripcion=:descripcion, categoria = :categoria, vigencia = :vigencia, precio = :precio,
             impuestos = :impuestos  WHERE id_Plan = :id_Plan");
            return $stmt->execute([
                'id_Plan' => $id,
                'nombre' => $plan['nombre'],
                'descripcion' => $plan['descripcion'],
                'categoria' => $plan['categoria'],
                'vigencia' =>$plan['vigencia'],
                'precio' =>$plan['precio'],
                'impuestos' => $plan['impuestos']
            ]);
        }

        public function obtenerSuscripciones() {
            $stmt = $this->db->query("SELECT * FROM suscripciones");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function borrarSuscripciones($id) {
            $stmt = $this->db->prepare("DELETE FROM suscripciones WHERE id_Suscripcion = :id_Suscripcion");
            return $stmt->execute(['id_Suscripcion' => $id]);
        }
        public function actualizarSuscripciones($id, $plan) {
            $stmt = $this->db->prepare("UPDATE suscripciones SET fecha_Inicio = :fecha_Inicio, fecha_Renovacion=:fecha_Renovacion, estatus = :estatus, serie = :serie, codigo = :codigo,
             impuestos = :impuestos  WHERE id_Suscripcion = :id_Suscripcion");
            return $stmt->execute([
                'id_Suscripcion' => $id,
                'nombre' => $plan['nombre'],
                'descripcion' => $plan['descripcion'],
                'categoria' => $plan['categoria'],
                'vigencia' =>$plan['vigencia'],
                'precio' =>$plan['precio'],
                'impuestos' => $plan['impuestos']
            ]);
        }

        
        public function verificarCorreo($email) {
            $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        }
        
        public function guardarCodigoRecuperacion($email, $codigo) {
            $sql = "UPDATE usuarios SET codigo_recuperacion = :codigo, codigo_expira = DATE_ADD(NOW(), INTERVAL 15 MINUTE) WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':codigo', $codigo, PDO::PARAM_INT);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
        }
        
        public function verificarCodigoRecuperacion($email, $codigo) {
            $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email AND codigo_recuperacion = :codigo AND codigo_expira > NOW()";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':codigo', $codigo, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        }
        


    }

