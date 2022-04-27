<?php
class Categories extends Database{
    private $_db,
    $categories_stmt;

    public function __construct($customer = null)
    {
    $this->_db = Database::getInstance();
    $this->$categories_stmt = $this->connect()->query("SELECT * FROM category ORDER BY id ASC;");
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert('category', $fields))
        {
            throw new Exception('error');
        }
    }

    public function fetchStockCategories()
    {
        return $this->$categories_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function stockCategoriesCount()
    {
        return $this->$categories_stmt->rowCount();
    }
}