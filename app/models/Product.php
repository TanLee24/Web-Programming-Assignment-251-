<?php
class Product {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function all($keyword = null, $brand = null) 
    {
        $sql = "SELECT * FROM products WHERE 1";

        if ($keyword) {
            $sql .= " AND name LIKE :keyword";
        }

        if ($brand) {
            $sql .= " AND brand = :brand";
        }

        $this->db->query($sql);

        if ($keyword) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }

        if ($brand) {
            $this->db->bind(':brand', $brand);
        }

        return $this->db->resultSet();
    }


    // Dùng query(), bind() và single()
    public function find($id) {
        $this->db->query("SELECT * FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single(); // Lấy 1 sản phẩm
    }

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
        $replace = array('a', 'e', 'i', 'o', 'u', 'y', 'd', 'A', 'E', 'I', 'O', 'U', 'Y', 'D', '-');
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        return strtolower($string);
    }

    public function create($name, $description, $price, $imgUrl, $brand) {
        $slug = $this->createSlug($name); // Tạo slug từ tên
        
        $sql = "INSERT INTO products (name, description, price, image_url, brand, slug) 
                VALUES (:name, :description, :price, :image_url, :brand, :slug)";
        
        $this->db->query($sql);
        $this->db->bind(':name', $name);
        $this->db->bind(':description', $description);
        $this->db->bind(':price', $price);
        $this->db->bind(':image_url', $imgUrl);
        $this->db->bind(':brand', $brand);
        $this->db->bind(':slug', $slug); // Bind slug
        
        return $this->db->execute();
    }

    public function update($id, $name, $description, $price, $imgUrl, $brand) { 
        $slug = $this->createSlug($name); // Cập nhật slug mới khi sửa tên

        $sql = "UPDATE products 
                SET name = :name, description = :description, price = :price, 
                    image_url = :image_url, brand = :brand, slug = :slug 
                WHERE id = :id";
                
        $this->db->query($sql);
        $this->db->bind(':name', $name);
        $this->db->bind(':description', $description);
        $this->db->bind(':price', $price);
        $this->db->bind(':image_url', $imgUrl);
        $this->db->bind(':brand', $brand);
        $this->db->bind(':slug', $slug); // Bind slug
        $this->db->bind(':id', $id);
        
        return $this->db->execute();
    }

    // Dùng query(), bind() và execute()
    public function delete($id) 
    {
        $this->db->query("DELETE FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getUniqueBrands() 
    {
        $sql = "SELECT DISTINCT brand FROM products WHERE brand IS NOT NULL AND brand != '' ORDER BY brand ASC";
        $this->db->query($sql);
        return $this->db->resultSet(); // Trả về danh sách các hãng
    }

    public function getSizes($productId) 
    {
        $this->db->query("SELECT * FROM product_sizes WHERE product_id = :id ORDER BY size");
        $this->db->bind(':id', $productId);
        return $this->db->resultSet();
    }

    public function findBySlug($slug) {
        $this->db->query("SELECT * FROM products WHERE slug = :slug");
        $this->db->bind(':slug', $slug);
        return $this->db->single();
    }

    public function countAll($keyword = null, $brand = null) 
    {
        $sql = "SELECT COUNT(*) as total FROM products WHERE 1";

        if ($keyword) {
            $sql .= " AND name LIKE :keyword";
        }
        if ($brand) {
            $sql .= " AND brand = :brand";
        }

        $this->db->query($sql);

        if ($keyword) {
            $this->db->bind(':keyword', "%$keyword%");
        }
        if ($brand) {
            $this->db->bind(':brand', $brand);
        }

        $row = $this->db->single();
        return $row->total ?? 0;
    }

    public function getPaginated($limit, $offset, $keyword = null, $brand = null)
    {
        $sql = "SELECT * FROM products WHERE 1";

        if ($keyword) {
            $sql .= " AND name LIKE :keyword";
        }
        if ($brand) {
            $sql .= " AND brand = :brand";
        }

        $sql .= " ORDER BY id DESC LIMIT :limit OFFSET :offset";

        $this->db->query($sql);

        if ($keyword) {
            $this->db->bind(':keyword', "%$keyword%");
        }
        if ($brand) {
            $this->db->bind(':brand', $brand);
        }

        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);

        return $this->db->resultSet();
    }
    public function getAllBrands()
    {
        $this->db->query("SELECT DISTINCT brand FROM products ORDER BY brand ASC");
        return $this->db->resultSet();
    }

}