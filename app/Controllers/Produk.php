<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Produk extends ResourceController
{
    use ResponseTrait;

    public function index($id = null) // kalo id tidak kosong maka select berdasarkan id
    {
        $loadModel = new ProdukModel();

        $datas['produk'] = $loadModel->orderBy('id', 'DESC')->findAll();

        return $this->respond($datas);
    }

    public function show($id = null)
    {
        $model = new ProdukModel();

        $data = $model->where('id', $id)->first();

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data barang tidak ada');
        }
    }

    public function create()
    {
        $model = new ProdukModel();

        $request = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'variant'  => $this->request->getVar('variant'),
            'stok'  => $this->request->getVar('stok'),
            'harga_beli'  => $this->request->getVar('harga_beli'),
            'harga_jual'  => $this->request->getVar('harga_jual'),
        ];

        $create = $model->insert($request);

        if ($create) {
            $respon = [
                'status'   => 201,
                'pesan' => [
                    'success' => 'Data berhasil di input'
                ]
            ];
        } else {
            $respon = [
                'status'   => 500,
                'pesan' => [
                    'success' => 'Error, data belum berhasil di input'
                ]
            ];
        }

        return $this->respondCreated($respon);
    }

    public function update($id = null)
    {
        $model = new ProdukModel();

        $request = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'variant'  => $this->request->getVar('variant'),
            'stok'  => $this->request->getVar('stok'),
            'harga_beli'  => $this->request->getVar('harga_beli'),
            'harga_jual'  => $this->request->getVar('harga_jual'),
        ];

        $update = $model->update($id, $request);

        if ($update) {
            $respon = [
                'status'   => 200,
                'messages' => [
                    'success' => "Data berhasil di update"
                ]
            ];
        } else {
            $respon = [
                'status'   => 500,
                'messages' => [
                    'success' => "Data belum berhasil di update"
                ]
            ];
        }

        return $this->respond($respon);
    }

    public function delete($id = null)
    {
        $model = new ProdukModel();

        $dataBarang = $model->where('id', $id);

        if ($dataBarang) {
            $model->delete($id);
            $respon = [
                'status'   => 200,
                'messages' => [
                    'success' => 'Data berhasil di hapus'
                ]
            ];

            return $this->respondDeleted($respon);
        } else {
            return $this->failNotFound("Produk dengan id tidak ada");
        }
    }
}
