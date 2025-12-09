<?php
class News {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function all($keyword = null) {
        $sql = "SELECT * FROM news";
        if ($keyword) {
            $sql .= " WHERE title LIKE '%$keyword%' OR content LIKE '%$keyword%'";
        }
        $sql .= " ORDER BY created_at DESC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function find($id) {
        $this->db->query("SELECT * FROM news WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Hàm tạo Slug (biến Tiêu Đề thành tieu-de-khong-dau)
    public function createSlug($string) {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a', 'e', 'i', 'o', 'u', 'y', 'd',
            'A', 'E', 'I', 'O', 'U', 'Y', 'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        return strtolower($string);
    }

    public function create($title, $content, $imgUrl) {
        // Tự động tạo slug từ title
        $slug = $this->createSlug($title);

        $sql = "INSERT INTO news (title, content, featured_image_url, slug, created_at) 
                VALUES (:title, :content, :img, :slug, NOW())";
        
        $this->db->query($sql);
        $this->db->bind(':title', $title);
        $this->db->bind(':content', $content);
        $this->db->bind(':img', $imgUrl);
        $this->db->bind(':slug', $slug);
        
        return $this->db->execute();
    }

    public function update($id, $title, $content, $imgUrl) {
        // Nếu tiêu đề đổi, slug cũng nên đổi theo 
        $slug = $this->createSlug($title);

        $sql = "UPDATE news SET 
                title = :title, 
                content = :content, 
                featured_image_url = :img, 
                slug = :slug 
                WHERE id = :id";
        
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $this->db->bind(':title', $title);
        $this->db->bind(':content', $content);
        $this->db->bind(':img', $imgUrl);
        $this->db->bind(':slug', $slug);
        
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM news WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Lấy thông tin một bài viết theo ID
    public function getNewsById($id) {
        $this->db->query("SELECT * FROM news WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Cập nhật bài viết
    public function updateNews($data) {
        $this->db->query("UPDATE news SET title = :title, content = :content, featured_image_url = :image, slug = :slug WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':image', $data['featured_image_url']);
        $this->db->bind(':slug', $data['slug']);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findBySlug($slug) {
        $this->db->query("SELECT * FROM news WHERE slug = :slug");
        $this->db->bind(':slug', $slug);
        return $this->db->single();
    }

    // Phân trang cho danh sách tin tức
    // 1. Đếm tổng số bài viết (Có hỗ trợ tìm kiếm)
    public function countAll($keyword = null) {
        $sql = "SELECT COUNT(*) as total FROM news";
        
        if ($keyword) {
            $sql .= " WHERE title LIKE :keyword OR content LIKE :keyword";
        }
        
        $this->db->query($sql);
        
        if ($keyword) {
            $this->db->bind(':keyword', "%$keyword%");
        }
        
        $row = $this->db->single();
        return $row->total;
    }

    // 2. Lấy danh sách tin tức phân trang (Có hỗ trợ tìm kiếm)
    public function getPaginated($limit, $offset, $keyword = null) {
        $sql = "SELECT * FROM news";
        
        if ($keyword) {
            $sql .= " WHERE title LIKE :keyword OR content LIKE :keyword";
        }
        
        $sql .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
        
        $this->db->query($sql);
        
        if ($keyword) {
            $this->db->bind(':keyword', "%$keyword%");
        }
        
        // Bind tham số LIMIT và OFFSET (ép kiểu int)
        $this->db->bind(':limit', (int)$limit);
        $this->db->bind(':offset', (int)$offset);
        
        return $this->db->resultSet();
    }
}