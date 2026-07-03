<?php
/**
 * Model de Passeios/Tours
 */
class TourModel
{
    private $db;
    private $table = 'tours';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll($page = 1, $perPage = 12, $filters = [])
    {
        $offset = ($page - 1) * $perPage;
        $where = ["t.status = 'active'"];
        $params = [];

        if (!empty($filters['category'])) {
            $where[] = "t.category_id = :category";
            $params[':category'] = $filters['category'];
        }

        if (!empty($filters['activity_type'])) {
            $where[] = "t.activity_type = :activity_type";
            $params[':activity_type'] = $filters['activity_type'];
        }

        if (!empty($filters['duration_days'])) {
            $where[] = "t.duration_days = :duration_days";
            $params[':duration_days'] = $filters['duration_days'];
        }

        if (!empty($filters['price_min'])) {
            $where[] = "t.price_from >= :price_min";
            $params[':price_min'] = $filters['price_min'];
        }

        if (!empty($filters['price_max'])) {
            $where[] = "t.price_from <= :price_max";
            $params[':price_max'] = $filters['price_max'];
        }

        if (!empty($filters['search'])) {
            $where[] = "(t.name LIKE :search OR t.description LIKE :search2)";
            $params[':search'] = '%' . $filters['search'] . '%';
            $params[':search2'] = '%' . $filters['search'] . '%';
        }

        $whereClause = implode(' AND ', $where);

        $sql = "SELECT t.*, c.name as category_name 
                FROM {$this->table} t 
                LEFT JOIN tour_categories c ON t.category_id = c.id 
                WHERE {$whereClause} 
                ORDER BY t.featured DESC, t.sort_order ASC, t.created_at DESC 
                LIMIT {$perPage} OFFSET {$offset}";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getFeatured($limit = 5)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE status = 'active' AND featured = 1 
             ORDER BY sort_order ASC LIMIT :limit"
        );
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function findBySlug($slug)
    {
        $stmt = $this->db->prepare(
            "SELECT t.*, c.name as category_name 
             FROM {$this->table} t 
             LEFT JOIN tour_categories c ON t.category_id = c.id 
             WHERE t.slug = :slug AND t.status = 'active'"
        );
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} 
            (name, slug, description, overview, highlights, inclusions, exclusions, 
             what_to_bring, restrictions, pregnant_allowed, duration_hours, duration_days,
             price_from, discount_percent, category_id, activity_type, featured, 
             sort_order, status, image_url, gallery, created_at) 
            VALUES 
            (:name, :slug, :description, :overview, :highlights, :inclusions, :exclusions,
             :what_to_bring, :restrictions, :pregnant_allowed, :duration_hours, :duration_days,
             :price_from, :discount_percent, :category_id, :activity_type, :featured,
             :sort_order, :status, :image_url, :gallery, NOW())"
        );
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $data[':id'] = $id;
        $data[':updated_at'] = date('Y-m-d H:i:s');
        
        $fields = [];
        foreach ($data as $key => $value) {
            if ($key !== ':id' && $key !== ':updated_at') {
                $fieldName = ltrim($key, ':');
                $fields[] = "{$fieldName} = {$key}";
            }
        }
        $fields[] = "updated_at = :updated_at";

        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET status = 'deleted' WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getPackages($tourId)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM tour_packages WHERE tour_id = :tour_id AND status = 'active' ORDER BY sort_order ASC"
        );
        $stmt->execute([':tour_id' => $tourId]);
        return $stmt->fetchAll();
    }

    public function getAgeGroups($packageId)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM tour_age_groups WHERE package_id = :package_id ORDER BY min_age ASC"
        );
        $stmt->execute([':package_id' => $packageId]);
        return $stmt->fetchAll();
    }

    public function getFaq($tourId)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM tour_faqs WHERE tour_id = :tour_id ORDER BY sort_order ASC"
        );
        $stmt->execute([':tour_id' => $tourId]);
        return $stmt->fetchAll();
    }

    public function getReviews($tourId, $limit = 10)
    {
        $stmt = $this->db->prepare(
            "SELECT r.*, u.name as user_name 
             FROM tour_reviews r 
             LEFT JOIN users u ON r.user_id = u.id 
             WHERE r.tour_id = :tour_id AND r.status = 'approved' 
             ORDER BY r.created_at DESC LIMIT :limit"
        );
        $stmt->bindValue(':tour_id', $tourId, \PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRelated($tourId, $categoryId, $limit = 4)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} 
             WHERE id != :id AND category_id = :category_id AND status = 'active' 
             ORDER BY RAND() LIMIT :limit"
        );
        $stmt->bindValue(':id', $tourId, \PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $categoryId, \PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getDocuments($tourId)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM tour_documents WHERE tour_id = :tour_id ORDER BY required DESC, name ASC"
        );
        $stmt->execute([':tour_id' => $tourId]);
        return $stmt->fetchAll();
    }

    public function getAvailability($tourId, $date)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM tour_availability 
             WHERE tour_id = :tour_id AND date = :date AND spots_available > 0"
        );
        $stmt->execute([':tour_id' => $tourId, ':date' => $date]);
        return $stmt->fetchAll();
    }

    public function count($filters = [])
    {
        $where = ["status = 'active'"];
        $params = [];

        if (!empty($filters['category'])) {
            $where[] = "category_id = :category";
            $params[':category'] = $filters['category'];
        }

        $whereClause = implode(' AND ', $where);
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM {$this->table} WHERE {$whereClause}");
        $stmt->execute($params);
        return $stmt->fetch()['total'];
    }
}
