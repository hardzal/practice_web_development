<?php

class Model
{
    private $connect;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function showAllCustomer()
    {
        $query = "SELECT * FROM customers";
        $result = $this->connect->query($query) or die($this->connect->error);

        return $result;
    }

    public function showOrderCustomer($id)
    {
        $query = "SELECT * FROM orders INNER JOIN customers ON customers.CustomerID = orders.CustomerID WHERE orders.CustomerID = ?";

        $stmt = $this->connect->prepare($query);

        $stmt->bind_param('s', $id);

        if ($stmt->execute()) {
            return $stmt->get_result();
        }

        return false;
    }

    public function showOrderDetails($id)
    {
        $query = "SELECT * FROM orderdetails INNER JOIN products ON products.ProductID = orderDetails.ProductID WHERE OrderID = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return $stmt->get_result();
        }

        return false;
    }
}
