<?php 

namespace App\Models;
  
use CodeIgniter\Model;
// use CodeIgniter\Database\ConnectionInterface;
  
class VehicleModel extends Model {
    protected $DBGroup          = 'default';
    protected $db;
    // protected $table = 'vehicles';
    // protected $allowedFields = ['id', 'name','type','year_of_manufacture', 'date_of_purchase','created_at', 'updated_at', 'user_id'];

    function __construct(){
        $this->db = \Config\Database::connect();
    }

    public function getVehicles($userid) {
        $res = $this->db->query("SELECT * FROM vehicles WHERE user_id = '$userid'");
        $result = $res->getResultArray();
        return $result;
    }

    public function insertData($userid, $vName, $vType, $yom ,$dop) {

        $res = $this->db->query("INSERT INTO vehicles 
                        (name, type, year_of_manufacture, date_of_purchase, user_id) 
                        VALUES 
                        ('$vName', '$vType', '$yom', '$dop', '$userid')");
        // $result = $res->getResultArray();
        return $res;
    }

    public function deleteData($userid, $vehicle_id) {
        $res = $this->db->query("DELETE FROM vehicles WHERE id= '$vehicle_id' AND user_id = '$userid'");
        // $result = $res->getResultArray();
        return $res;
    }

    public function updateData($userid, $vehicle_id, $vName, $vType, $yom ,$dop) {
        $res = $this->db->query("UPDATE vehicles 
        SET name='$vName', type='$vType', year_of_manufacture='$yom', date_of_purchase='$dop',updated_at=now()
        WHERE id= '$vehicle_id' AND user_id = '$userid'");
        // $result = $res->getResultArray();
        return $res;
    }

    public function getUpdateData($userid, $vehicle_id) {
        $res = $this->db->query("SELECT * FROM vehicles WHERE user_id = '$userid' AND id='$vehicle_id'");
        $result = $res->getResultArray();
        return $result;
    }
}