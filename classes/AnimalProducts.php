<?php
class AnimalProducts extends Database{
    private $_db,
    $product_units_stmt;

    public function __construct($customer = null)
    {
    $this->_db = Database::getInstance();
    $this->$product_units_stmt = $this->connect()->query("SELECT animal_product_units.id as id, Name, Quantity FROM animal_product_units inner join stock on animal_product_units.stock_id = stock.id ORDER BY id ");
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert('animal_product_units', $fields))
        {
            throw new Exception('error');
        }
    }

    public function fetchProductUnits()
    {
        return $this->$product_units_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function productUnitsCount()
    {
        return $this->$product_units_stmt->rowCount();
    }

    public function fetchUnitName($id)
    {
        $query = $this->connect()->query("SELECT stock.Name as unit FROM animal_product_units INNER JOIN stock ON animal_product_units.animal_product_unit_id = stock.id  WHERE animal_product_units.id = '$id'");
        return $query->fetch()['unit'];
    }

    public function fetchUnitQuantity($id)
    {
        $query = $this->connect()->query("SELECT Quantity FROM animal_product_units INNER JOIN stock ON animal_product_units.animal_product_unit_id = stock.id  WHERE animal_product_units.id = '$id'");
        return $query->fetch()['Quantity'];
    }
}