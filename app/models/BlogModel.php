<?php
/**
 * Model de Blog
 */
class BlogModel
{
    private $db;
    private $table = 'blog_posts';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll($page = 1, $perPage = 9, $category = null)
    {
        $offset = ($page - 1) * $perPage;
        $where = "p.status = 'published'";
        $params = [];

        if ($category) {
            $where .= " AND p.category_id = :category";
            $params[':category'] = $category;
        }

        $sql = "SELECT p.*, c.name as category_name, u.name as author_name 
                FROM {$this->table} p 
                LEFT JOIN blog_categories c ON p.category_id = c.id 
                LEFT JOIN users u ON p.author_id = u.id 
                WHERE {$where} 
                ORDER BY p.published_at DESC 
                LIMIT {$perPage} OFFSET {$offset}";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getRecent($limit = 3)
    {
        $stmt = $this->db->prepare(
            "SELECT p.*, c.name as category_name, u.name as author_name 
             FROM {$this->table} p 
             LEFT JOIN blog_categories c ON p.category_id = c.id 
             LEFT JOIN users u ON p.author_id = u.id 
             WHERE p.status = 'published' 
             ORDER BY p.published_at DESC LIMIT :limit"
        );
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findBySlug($slug)
    {
        $stmt = $this->db->prepare(
            "SELECT p.*, c.name as category_name, u.name as author_name 
             FROM {$this->table} p 
             LEFT JOIN blog_categories c ON p.category_id = c.id 
             LEFT JOIN users u ON p.author_id = u.id 
             WHERE p.slug = :slug AND p.status = 'published'"
        );
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} 
            (title, slug, excerpt, content, image_url, category_id, author_id, status, published_at, created_at) 
            VALUES (:title, :slug, :excerpt, :content, :image_url, :category_id, :author_id, :status, :published_at, NOW())"
        );
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $data[':id'] = $id;
        $fields = [];
        foreach ($data as $key => $value) {
            if ($key !== ':id') {
                $fieldName = ltrim($key, ':');
                $fields[] = "{$fieldName} = {$key}";
            }
        }
        $fields[] = "updated_at = NOW()";

        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET status = 'deleted' WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function count($category = null)
    {
        $where = "status = 'published'";
        $params = [];
        if ($category) {
            $where .= " AND category_id = :category";
            $params[':category'] = $category;
        }
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM {$this->table} WHERE {$where}");
        $stmt->execute($params);
        return $stmt->fetch()['total'];
    }

    public function getCategories()
    {
        return $this->db->query("SELECT * FROM blog_categories ORDER BY name ASC")->fetchAll();
    }
}
