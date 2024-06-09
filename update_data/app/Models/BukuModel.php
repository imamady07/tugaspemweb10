<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';

    protected $useTimestamps = true;

    protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];

    public function getBuku($slug = false)
    {
        if ($slug == false) {
            return $this->findall();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
