<?php
class Stock extends Database{
    private $_db,
    $stock_stmt;

    public function __construct($customer = null)
    {
    $this->_db = Database::getInstance();
    $this->$stock_stmt = $this->connect()->query("SELECT s.id AS id,s.Name as Name,image,i_u.Name as unit_name,s.Discount as Discount, sf.Buying_price as Buying_price,sf.Selling_price as Price,c.Category_Name as Category_Name,s.Restock_Level as Restock_Level,s.Quantity as Quantity FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id JOIN inventory_units i_u ON s.Unit_id = i_u.id JOIN category c ON s.Category_id=c.id INNER JOIN (SELECT s.id AS max_id, MAX(sf.Created_at) AS max_created_at FROM stock s INNER JOIN stock_flow sf ON s.id = sf.Stock_id GROUP BY s.id) subQuery ON subQuery.max_id = s.id AND subQuery.max_created_at = sf.Created_at;");
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert('stock', $fields))
        {
            throw new Exception('error');
        }
    }

    public function deleteStock($id)
    {
        $this->_db->delete('stock', array('id' , '=', $id));
    }

    public function fetchStockImage($id)
    {
        $query = $this->connect()->query("SELECT image FROM stock WHERE id = '".$id."'");
        return $query->fetch()['image'];
    }

    public function addStockFlow()
    {
        die($fields);
        if(!$this->_db->insert('stock_flow', $fields))
        {
            throw new Exception('error');
        }
    }

    public function fetchStockId($name)
    {
        $query = $this->connect()->query("SELECT * FROM stock WHERE Name = '".$name."'");
        return $query->fetch()['id'];
    }

    public function stockExists($name)
    {
        $data = $this->_db->get('stock', '*', array('Name', '=', $name));
        if($data->count())
        {
            return true;        
        }
        return false;
    }

    public function fetchStock()
    {
        return $this->$stock_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function stockCount()
    {
        return $this->$stock_stmt->rowCount();
    }

}