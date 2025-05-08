<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    
    // Menambahkan 'role' ke allowedFields
    protected $allowedFields = ['nama', 'email', 'password', 'reset_token', 'reset_token_expired_at', 'role'];
    
    protected $useTimestamps = true;
}
