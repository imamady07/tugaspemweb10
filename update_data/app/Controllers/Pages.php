<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Unipdu Pres'
        ];
        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Me'
        ];
        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Godong Gudo',
                    'kota' => 'Jombang'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Kompleks Ponpes Darul Ulum Peterongan',
                    'kota' => 'Jombang'
                ]
            ]
        ];
        return view('pages/contact', $data);
    }
}
