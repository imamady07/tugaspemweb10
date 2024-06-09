<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
  protected $bukuModel;

  public function __construct()
  {
    $this->bukuModel = new BukuModel();
  }

  public function index()
  {

    $data = [
      'title' => 'Daftar Buku',
      'buku' => $this->bukuModel->getBuku()
    ];

    return view('buku/index', $data);
  }

  public function detail($slug)
  {
    $buku = $this->bukuModel->getBuku($slug);
    $data = [
      'title' => 'Detail Buku',
      'buku' => $this->bukuModel->getBuku($slug)
    ];

    // jika buku tidak ada di tabel
    if (empty($data['buku'])) {
      throw new \Codeigniter\Exceptions\PageNotFoundException('Judul buku ' . $slug . ' tidak ditemukan.');
    }
    return view('buku/detail', $data);
  }

  public function create()
  {
    // session();
    $data = [
      'title' => 'Form Tambah Data Buku',
      // 'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation()
      'validation' => \Config\Services::validation()
    ];

    return view('buku/create', $data);
  }

  public function save()
  {

    // validasi input
    if (
      !$this->validate([
        'judul' => [
          'rules' => 'required|is_unique[buku.judul]',
          'errors' => [
            'required' => '{field} buku harus diisi.',
            'is_unique' => '{field} buku sudah ada'
          ]
        ]
      ])
    ) {
      // session()->setFlashdata('validation', \Config\Services::validation());
      return redirect()->to('/buku/create')->withInput();
      // $validation = \Config\Services::validation();
      // return redirect()->to('/buku/create')->withInput()->with('validation', $validation);
    }

    $slug = url_title($this->request->getVar('judul'), '-', true);
    $this->bukuModel->save([
      'judul' => $this->request->getVar('judul'),
      'slug' => $slug,
      'penulis' => $this->request->getVar('penulis'),
      'penerbit' => $this->request->getVar('penerbit'),
      'sampul' > $this->request->getVar('sampul')
    ]);

    session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

    return redirect()->to('/buku');

  }

  public function delete($id)
  {
    $this->bukuModel->delete($id);
    session()->setFlashdata('pesan', 'Data berhasil dihapus');
    return redirect()->to('/buku');
  }

  public function edit($slug)
    {
        // session();

        $data = [
            'title' => 'Form Edit Data Buku',
            'validation' => \Config\Services::validation(),
            'buku' => $this->bukuModel->getBuku($slug)
        ];

        return view('buku/edit', $data);
    }

    public function update($id)
    {
        // $bukulama = $this->bukuModel->getBuku($this->request->getVar('slug'));
        // $bukulama = $this->bukuModel->getBuku($id);
        $bukulama = $this->bukuModel->find($id);

        // validasi judul
        if ($bukulama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[buku.judul]';
        }

        // validasi penulis
        if ($bukulama['penulis'] == $this->request->getVar('penulis')) {
            $rule_penulis = 'required';
        } else {
            $rule_penulis = 'required|is_unique[buku.penulis]';
        }

        // validasi penerbit
        if ($bukulama['penerbit'] == $this->request->getVar('penerbit')) {
            $rule_penerbit = 'required';
        } else {
            $rule_penerbit = 'required|is_unique[buku.penerbit]';
        }

        // validasi input
        if (
            !$this->validate([
                'judul' => [
                    'rules' => $rule_judul,
                    'errors' => [
                        'required' => '{field} buku harus diisi.',
                        'is_unique' => '{field} buku sudah terdaftar'
                    ]
                ],
                'penulis' => [
                    'rules' => $rule_penulis,
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ],
                'penerbit' => [
                    'rules' => $rule_penerbit,
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ]
            ])
        ) {
            // session()->setFlashdata('validation' ?? \Config\Services::validation());
            // return redirect()->to('/buku/edit')->withInput();
            $validation = \Config\Services::validation();
            return redirect()->to('/buku/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
            // return redirect()->to('/buku/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bukuModel->save([
            'id'        => $id,
            'judul'     => $this->request->getVar('judul'),
            'slug'      => $slug,
            'penulis'   => $this->request->getVar('penulis'),
            'penerbit'  => $this->request->getVar('penerbit'),
            'sampul'    => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/buku');
    }
}