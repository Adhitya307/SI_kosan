<?php

namespace App\Controllers;

use App\Models\UserModel;
use Google_Client;
use Google_Service_Oauth2;
use CodeIgniter\Email\Email;

class Auth extends BaseController {
    public function register() {
        return view('Auth/register');
    }

    public function process_register() {
        $model = new UserModel();
        
        // Menambahkan role secara default
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'customer'  // Menetapkan default role sebagai 'customer'
        ];
        
        $model->save($data);
        return redirect()->to('/login');
    }
    

    public function login() {
        return view('Auth/login');
    }

    public function process_login() {
        $model = new UserModel();
        $user = $model->where('email', $this->request->getPost('email'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set('user', $user);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Login gagal');
    }

    public function logout() {
        session()->destroy(); // Menghancurkan sesi
        return redirect()->to('/login'); // Mengarahkan kembali ke halaman login
    }
    
    public function setPassword()
{
    $user = session()->get('user');
    if (!$user) return redirect()->to('/login');

    return view('auth/set_password');
}

public function savePassword()
{
    $user = session()->get('user');
    if (!$user) return redirect()->to('/login');

    $password = $this->request->getPost('password');
    $konfirmasi = $this->request->getPost('konfirmasi');

    if ($password !== $konfirmasi) {
        return redirect()->back()->with('error', 'Konfirmasi tidak cocok');
    }

    $model = new \App\Models\UserModel();
    $model->update($user['id'], [
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);

    $updatedUser = $model->find($user['id']);
    session()->set('user', $updatedUser);

    return redirect()->to('/dashboard');
}

public function forgotPasswordForm()
{
    return view('auth/forgot_password');
}

public function sendResetToken()
{
    $email = $this->request->getPost('email');
    $model = new UserModel();
    $user = $model->where('email', $email)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Email tidak ditemukan');
    }

    // Generate token & expiry
    $token = bin2hex(random_bytes(32));
    $expire = date('Y-m-d H:i:s', time() + 3600); // 1 jam

    // Simpan token
    $model->update($user['id'], [
        'reset_token' => $token,
        'reset_token_expired_at' => $expire
    ]);

    // Kirim email
    $emailService = \Config\Services::email();
    $resetLink = base_url('/reset-password?token=' . $token);
    $emailService->setTo($email);
    $emailService->setSubject('Reset Password Anda - TaskTim');
    $emailService->setMessage("Klik link berikut untuk mengatur ulang password Anda:<br><a href=\"$resetLink\">$resetLink</a>");

    if (!$emailService->send()) {
        return redirect()->back()->with('error', 'Gagal mengirim email. Coba lagi.');
    }

    return redirect()->to('/login')->with('success', 'Email reset sudah dikirim!');
}

public function resetPasswordForm()
{
    $token = $this->request->getGet('token');
    $model = new UserModel();
    $user = $model->where('reset_token', $token)
                  ->where('reset_token_expired_at >=', date('Y-m-d H:i:s'))
                  ->first();

    if (!$user) {
        return redirect()->to('/login')->with('error', 'Token tidak valid atau sudah kadaluarsa.');
    }

    return view('auth/reset_password', ['token' => $token]);
}

public function updatePasswordFromToken()
{
    $token = $this->request->getPost('token');
    $password = $this->request->getPost('password');
    $konfirmasi = $this->request->getPost('konfirmasi');

    if ($password !== $konfirmasi) {
        return redirect()->back()->with('error', 'Konfirmasi password tidak cocok');
    }

    $model = new UserModel();
    $user = $model->where('reset_token', $token)
                  ->where('reset_token_expired_at >=', date('Y-m-d H:i:s'))
                  ->first();

    if (!$user) {
        return redirect()->to('/login')->with('error', 'Token tidak valid atau sudah kadaluarsa.');
    }

    $model->update($user['id'], [
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'reset_token' => null,
        'reset_token_expired_at' => null
    ]);

    return redirect()->to('/login')->with('success', 'Password berhasil diubah.');
}
}