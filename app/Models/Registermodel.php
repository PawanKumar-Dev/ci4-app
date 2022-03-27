<?php
namespace App\Models;
use CodeIgniter\Model;

class Registermodel extends Model
{
  public $db;

  // Constructor for DB
  // ===================
  public function __construct()
  {
    $this->db = \Config\Database::connect();
  }

  // Methods for inserting User data
  // =================================
  public function registerUser($data)
  {
    $builder = $this->db->table('users');
    $result = $builder->insert($data);

    return $result;
  }


  // Getting data based on uniid(returns only a single row)
  // ======================================================
  public function getDataById($id)
  {
    $builder = $this->db->table('users');
    $result = $builder->where('uniid', $id)->get();

    return $result->getRowArray();
  }


  // Update Status after activating link
  // ====================================
  public function updateStatus($upStatus, $user_id)
  {
    $builder = $this->db->table('users');
    $result =  $builder->where('id', $user_id)->update($upStatus);

    return $result;
  }

}