<?php
// Create Customer class
class Customer
{
    private $db;

    // Constructor
    public function __construct()
    {
        $this->db = new Database();
    }

    // Add Customer
    public function addCustomer(array $data)
    {
        // Query data
        $this->db->query(
            'INSERT INTO customers (id, firstName, lastName, email) VALUES (:id, :firstName, :lastName, :email)'
        );

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':firstName', $data['firstName']);
        $this->db->bind(':lastName', $data['lastName']);
        $this->db->bind(':email', $data['email']);

        // Execute statement
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
