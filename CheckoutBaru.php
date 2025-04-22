<?php

namespace App\Controllers;
use App\Models\CustomerModel;
use App\Models\KeranjangModel;

class Checkout extends BaseController
{
    public function index($kode_cs)
    {
        $customerModel = new CustomerModel();
        $keranjangModel = new KeranjangModel();

        $data = [
            'kode_cs' => $kode_cs,
            'customer' => $customerModel->where('kode_customer', $kode_cs)->first(),
            'pesanan' => $keranjangModel->where('kode_customer', $kode_cs)->findAll()
        ];

        // Pastikan menggunakan $this->include() dalam Controller
        return view('checkout', $data);
    }
}
