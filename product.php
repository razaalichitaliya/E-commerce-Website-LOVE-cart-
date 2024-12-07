<?php

//Using OOPS
class Product {
    private $db;
    private $userId;

    public function __construct($db, $userId) {
        $this->db = $db;
        $this->userId = $userId;
    }

    // Fetch products from the database
    public function getProducts() {
        $sql = "SELECT * FROM products";
        return $this->db->query($sql);
    }

    // Add product to cart
    public function addToCart($productId, $quantity) {
        // Check if the product is already in the cart
        $sql = "SELECT * FROM addtocart WHERE userid = ? AND productid = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $this->userId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // If product is already in the cart, update quantity
            $sql = "UPDATE addtocart SET quantity = quantity + ? WHERE userid = ? AND productid = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("iii", $quantity, $this->userId, $productId);
        } else {
            // If product is not in the cart, insert new entry
            $sql = "INSERT INTO addtocart (userid, productid, quantity) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("iii", $this->userId, $productId, $quantity);
        }

        return $stmt->execute();
    }

    // Count items in the cart for this user
    public function getCartCount() {
        $sql = "SELECT COUNT(*) AS row_count FROM addtocart WHERE userid = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $this->userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['row_count'];
    }
    // Fetch cart items for the user
public function getCartItems() {
    $sql = "SELECT a.productid, a.quantity, p.productname, p.price 
            FROM addtocart a 
            JOIN products p ON a.productid = p.productid 
            WHERE a.userid = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $this->userId);
    $stmt->execute();
    return $stmt->get_result();
}

}
?>
