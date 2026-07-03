<?php
/**
 * Model de Usuários
 */
class UserModel
{
    private $db;
    private $table = 'users';

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Buscar usuário por email
     */
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Buscar usuário por ID
     */
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Criar novo usuário
     */
    public function create($data)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (name, email, password, phone, role, status, created_at) 
             VALUES (:name, :email, :password, :phone, :role, :status, NOW())"
        );
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':phone' => $data['phone'] ?? null,
            ':role' => $data['role'] ?? 'client',
            ':status' => $data['status'] ?? 'active',
        ]);
        return $this->db->lastInsertId();
    }

    /**
     * Atualizar usuário
     */
    public function update($id, $data)
    {
        $fields = [];
        $params = [':id' => $id];

        foreach ($data as $key => $value) {
            if ($key === 'password') {
                $value = password_hash($value, PASSWORD_DEFAULT);
            }
            $fields[] = "{$key} = :{$key}";
            $params[":{$key}"] = $value;
        }

        $fields[] = "updated_at = NOW()";
        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Deletar usuário
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Listar todos os usuários com paginação
     */
    public function getAll($page = 1, $perPage = 20, $role = null)
    {
        $offset = ($page - 1) * $perPage;
        $where = '';
        $params = [];

        if ($role) {
            $where = "WHERE role = :role";
            $params[':role'] = $role;
        }

        $sql = "SELECT * FROM {$this->table} {$where} ORDER BY created_at DESC LIMIT {$perPage} OFFSET {$offset}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Contar total de usuários
     */
    public function count($role = null)
    {
        $where = '';
        $params = [];

        if ($role) {
            $where = "WHERE role = :role";
            $params[':role'] = $role;
        }

        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM {$this->table} {$where}");
        $stmt->execute($params);
        return $stmt->fetch()['total'];
    }

    /**
     * Verificar senha
     */
    public function verifyPassword($email, $password)
    {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
