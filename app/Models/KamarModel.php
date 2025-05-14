<?php

namespace App\Models;

use CodeIgniter\Model;

class KamarModel extends Model
{
    protected $table      = 'kamar';
    protected $primaryKey = 'id';

    // Daftar field yang bisa di-insert/update
    protected $allowedFields = ['nama_kamar', 'status', 'harga', 'deskripsi', 'gambar'];

    // Validasi data
    protected $validationRules = [
        'nama_kamar' => 'required|min_length[3]|max_length[255]',
        'status'     => 'required|in_list[tersedia,terisi]',
        'harga'      => 'required|numeric',
        'deskripsi'  => 'permit_empty|string',
        'gambar'     => 'permit_empty|valid_image'
    ];

    // Pesan error untuk validasi
    protected $validationMessages = [
        'nama_kamar' => [
            'required' => 'Nama kamar harus diisi.',
            'min_length' => 'Nama kamar minimal 3 karakter.',
            'max_length' => 'Nama kamar maksimal 255 karakter.',
        ],
        'status' => [
            'required' => 'Status kamar harus dipilih.',
            'in_list' => 'Status kamar harus salah satu dari: tersedia, terisi.',
        ],
        'harga' => [
            'required' => 'Harga kamar harus diisi.',
            'numeric' => 'Harga kamar harus berupa angka.',
        ],
        'gambar' => [
            'valid_image' => 'Gambar harus berupa file gambar yang valid.',
        ],
    ];

    // Timestamps (untuk created_at dan updated_at)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
