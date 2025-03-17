<?php
class PurchaseManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // ✅ Get all materials that have pending requests
    public function approveRequest($purchaseId) {
        $query = "UPDATE purchases SET request = 1 WHERE id = :purchaseId"; 
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":purchaseId", $purchaseId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    

    public function getRequestedMaterials() {
        $query = "SELECT m.title, p.user_id, p.id AS purchase_id, p.user_id 
                  FROM purchases p
                  JOIN materials m ON p.material_id = m.id
                  WHERE p.request = 0"; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
