<?php
namespace App\Models;
use CodeIgniter\Model;

class Contactmodel extends Model
{
  public function insertDataInDB($data)
  {
    $db = \Config\Database::connect();

    $builder = $db->table('contactform');
    $result = $builder->insert($data);

    return $result;
  }
}