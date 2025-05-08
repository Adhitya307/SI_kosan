<?php

namespace App\Controllers;

use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Mendapatkan data pengguna yang sedang login dari session
        $user = session()->get('user');
        
        // Cek apakah pengguna sudah login dan memiliki role
        $role = $user ? $user['role'] : 'customer'; // Default 'customer' jika tidak ada role
        
        // Kirimkan data ke view
        return view('dashboard', ['role' => $role]);
    }
}
