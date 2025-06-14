<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class Users extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'nombres', 'apellidos', 'email', 'password', 'is_active', 'is_admin'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateUUID', 'hashPassword'];

    protected function generateUUID(array $data) 
    {
        $data['data']['id'] = Uuid::uuid4()->toString();
        return $data;
    }

    protected function hashPassword(array $data) 
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }

        return $data;
    }

    public function validateUser($email, $password) 
    {
        $user = $this->where(['email' => $email, 'is_active' => 1])->first();    
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }

    public function getUsersRoles()
    {
        return $this->select('users.id, users.nombres, users.apellidos, users.email, users.is_active, users.is_admin, users.created_at, roles.nombre AS rol')
        ->join('user_roles', 'user_roles.user_id = users.id', 'left')
        ->join('roles', 'roles.id = user_roles.role_id', 'left')
        ->orderBy('users.created_at', 'ASC')
        ->findAll();
    }

    
}
