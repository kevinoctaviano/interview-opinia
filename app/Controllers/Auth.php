<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class Auth extends ResourceController
{
    use ResponseTrait;
    public function __construct()
    {
        $this->user = new UserModel();
        $this->validation = \Config\Services::validation();
    }
    public function index()
    {
        $aturan = [
            "email" => [
                "rules"     => "required|valid_email",
                "errors"    => [
                    "required" => "Masukkan email!",
                    "valid_email" => "Masukkan email yang valid!"
                ]
            ],
            "password" => [
                "rules"     => "required",
                "errors"    => [
                    "required" => "Masukkan password!"
                ]
            ]
        ];
        $this->validation->setRules($aturan);
        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->fail($this->validation->getErrors());
        }
        $email = $this->request->getVar("email");
        $password = $this->request->getVar("password");

        $data = $this->user->where('email', $email)->findAll();

        if (!$data) {
            return $this->fail("Email tidak ditemukan!");
        }
        if (!password_verify($password, $data[0]['password'])) {
            return $this->fail("Password tidak sesuai!");
        }

        helper("jwt");
        $response = [
            "message" => "Autentikasi berhasil dilakukan",
            // "access_token" => createJWT($email, $data[0]['fullname'])
            "access_token" => createJWT($data[0]['id_user'])
        ];
        return $this->respond($response);
    }
    public function create()
    {
        $aturan = [
            "email" => [
                "rules"     => "required|valid_email",
                "errors"    => [
                    "required" => "Masukkan email!",
                    "valid_email" => "Masukkan email yang valid!"
                ]
            ],
            "password" => [
                "rules"     => "required",
                "errors"    => [
                    "required" => "Masukkan password!"
                ]
            ],
            "phone" => [
                "rules"     => "required",
                "errors"    => [
                    "required" => "Masukkan nomor telepon!"
                ]
            ],
            "fullname" => [
                "rules"     => "required",
                "errors"    => [
                    "required" => "Masukkan nama anda!"
                ]
            ],
        ];
        $this->validation->setRules($aturan);
        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->fail($this->validation->getErrors());
        }

        $email = $this->request->getVar("email");
        $rawPassword = $this->request->getVar("password");
        $fullname = $this->request->getVar('fullname');
        $phone = $this->request->getVar('phone');

        // hashing password 
        $password = password_hash($rawPassword, PASSWORD_BCRYPT);

        $data = [
            'email' => $email,
            'password' => $password,
            'fullname' => $fullname,
            'phone' => $phone,
        ];
        if (!$this->user->save($data)) {
            return $this->fail("Gagal melakukan registrasi, coba lagi!");
        }
        $response = [
            "message" => "Berhasil melakukan registrasi user!",
            "data" => $data
        ];
        return $this->respond($response);
    }
}
