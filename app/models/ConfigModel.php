<?php
/**
 * Model de Configurações do Sistema
 * Todas as configurações são salvas no banco de dados
 */
class ConfigModel
{
    private $db;
    private $table = 'system_configs';

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Retorna todas as configurações como array chave => valor
     */
    public function getAll()
    {
        try {
            $stmt = $this->db->query("SELECT config_key, config_value FROM {$this->table}");
            $configs = [];
            while ($row = $stmt->fetch()) {
                $configs[$row['config_key']] = $row['config_value'];
            }
            return $configs;
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * Retorna uma configuração específica
     */
    public function get($key, $default = '')
    {
        try {
            $stmt = $this->db->prepare("SELECT config_value FROM {$this->table} WHERE config_key = :key");
            $stmt->execute([':key' => $key]);
            $result = $stmt->fetch();
            return $result ? $result['config_value'] : $default;
        } catch (PDOException $e) {
            return $default;
        }
    }

    /**
     * Salva uma configuração (insert ou update)
     */
    public function set($key, $value)
    {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO {$this->table} (config_key, config_value, updated_at) 
                 VALUES (:key, :value, NOW()) 
                 ON DUPLICATE KEY UPDATE config_value = :value2, updated_at = NOW()"
            );
            return $stmt->execute([
                ':key' => $key,
                ':value' => $value,
                ':value2' => $value,
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Salva múltiplas configurações de uma vez
     */
    public function setMany($configs)
    {
        $this->db->beginTransaction();
        try {
            foreach ($configs as $key => $value) {
                $this->set($key, $value);
            }
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }

    /**
     * Remove uma configuração
     */
    public function delete($key)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE config_key = :key");
            return $stmt->execute([':key' => $key]);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Retorna configurações por grupo (prefixo)
     */
    public function getByGroup($prefix)
    {
        try {
            $stmt = $this->db->prepare(
                "SELECT config_key, config_value FROM {$this->table} WHERE config_key LIKE :prefix"
            );
            $stmt->execute([':prefix' => $prefix . '%']);
            $configs = [];
            while ($row = $stmt->fetch()) {
                $configs[$row['config_key']] = $row['config_value'];
            }
            return $configs;
        } catch (PDOException $e) {
            return [];
        }
    }
}
