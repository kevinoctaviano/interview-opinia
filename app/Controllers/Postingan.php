<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PostinganModel;
use App\Models\UserModel;

class Postingan extends ResourceController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->postingan = new PostinganModel();
        $this->user = new UserModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }
    public function index()
    {
        $data = $this->postingan->orderBy('id_postingan', 'ASC')->findAll();
        $response = [
            'data' => $data
        ];
        return $this->respond($response);
    }
    public function show($id = null)
    {
        $data = $this->postingan->where('id_postingan', $id)->findAll();
        if ($data) {
            $response = [
                'message' => "Berhasil mengambil data dengan id $id",
                'postingan' => $data
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound("Data postingan dengan id $id tidak ditemukan");
        }
    }
    public function create()
    {
        helper('jwt');
        $aturan = [
            "title" => [
                "rules"     => "required",
                "errors"    => [
                    "required" => "Masukkan judul postingan!",
                ]
            ],
            "description" => [
                "rules"     => "required",
                "errors"    => [
                    "required" => "Masukkan deskripsi postingan!"
                ]
            ],
            "post_type" => [
                "rules"     => "required",
                "errors"    => [
                    "required" => "Masukkan jenis postingan!"
                ]
            ]
        ];
        $this->validation->setRules($aturan);
        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->fail($this->validation->getErrors());
        }
        $title = $this->request->getVar('title');
        $description = $this->request->getVar('description');
        $post_type = $this->request->getVar('post_type');
        $user = $this->session->getFlashData('user');

        $data = [
            'user' => $user,
            'title' => $title,
            'description' => $description,
            'post_type' => $post_type,
        ];
        if (!$this->postingan->save($data)) {
            return $this->fail("Gagal menambahkan postingan, coba lagi!");
        }
        $response = [
            "message" => "Berhasil menambahkan postingan!",
            "data" => $data
        ];
        return $this->respond($response, 200);
    }
    public function update($id = null)
    {
        $rawInput = $this->request->getRawInput();
        if ($this->postingan->where('id_postingan', $id)->find()) {
            $this->postingan->set($rawInput);
            $this->postingan->update();
            $response = [
                'message' => "Berhasil mengubah postingan dengan id $id"
            ];
            return $this->respond($response, 200);
        } else {
            return $this->fail("Gagal mengubah postingan dengan id $id. Postingan dengan id $id tidak ditemukan!");
        }
    }
    public function delete($id = null)
    {
        $hapus = $this->postingan->where('id_postingan', $id)->find();
        if ($hapus) {
            $this->postingan->where('id_postingan', $id)->delete();
            $response = [
                'message' => "Berhasil menghapus postingan dengan id $id"
            ];
            return $this->respond($response, 200);
        } else {
            return $this->fail("Postingan dengan id $id tidak ditemukan!");
        }
    }
}
