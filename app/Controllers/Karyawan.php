<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use \Hermawan\DataTables\DataTable;
use Myth\Auth\Password;

class Karyawan extends ResourceController
{
    protected $helpers = ['form'];


    public function index()
    {
        $modelKaryawan = new KaryawanModel();
        $karyawan = $modelKaryawan->findAll();

        $data = [
            'karyawan' => $karyawan
        ];

        return view('data_master/karyawan/index', $data);
    }
    

    public function show($id = null)
    {
        if ($this->request->isAJAX()){
            $modelKaryawan = new KaryawanModel();
            $karyawan      = $modelKaryawan->find($id);

            $data = [
                'karyawan' => $karyawan,
            ];
            $json = [
                'data' => view('data_master/karyawan/show', $data),
            ];

            echo json_encode($json);
        }else{
            return 'Tidak bisa load';
        }
    }


    public function new()
    {
        if ($this->request->isAJAX()) {

            $modelKaryawan = new KaryawanModel();
            $karyawan = $modelKaryawan->findAll();

            $data = [
                'karyawan'        => $karyawan,
            ];

            $json = [
                'data'          => view('data_master/karyawan/add', $data),
            ];

            echo json_encode($json);
        } else {
            return 'Tidak bisa load';
        }
    }


    public function create()
        {
            if ($this->request->isAJAX()) {

                $validasi = [
                    'nik'  => [
                        'rules'     => 'required',
                        'errors'    =>[
                            'required' => '{field} nik harus diisi',
                        ]
                    ],
                    'jabatan'  => [
                        'rules'     => 'required',
                        'errors'    =>[
                            'required' => '{field} jabatan harus diisi',
                        ]
                    ],
                    'nama_lengkap'  => [
                        'rules'     => 'required',
                        'errors'    =>[
                            'required' => '{field} nama lengkap harus diisi',
                        ]
                    ],
                    'alamat'  => [
                        'rules'     => 'required',
                        'errors'    =>[
                            'required' => '{field} alamat harus diisi',
                        ]
                    ],
                    'jenis_kelamin'  => [
                            'rules'     => 'required',
                            'errors'    =>[
                                'required' => '{field} jenis kelamin harus diisi',
                        ]
                    ],
                    'tempat_lahir'  => [
                        'rules'     => 'required',
                        'errors'    =>[
                            'required' => '{field} tempat lahir harus diisi',
                        ]
                    ],
                    'tanggal_lahir'  => [
                        'rules'     => 'required',
                        'errors'    =>[
                            'required' => '{field} tanggal lahir harus diisi',
                        ]
                    ],  
                    'agama'  => [
                        'rules'     => 'required',
                        'errors'    =>[
                            'required' => '{field} agama harus diisi',
                        ]
                    ], 
                    'pendidikan'  => [
                        'rules'     => 'required',
                        'errors'    =>[
                            'required' => '{field} pendidikan harus diisi',
                        ]
                    ],    
                    'no_telp'  => [
                        'rules'     => 'required',
                        'errors'    =>[
                            'required' => '{field} no telepon harus diisi',
                        ]
                    ], 
                    'email'  => [
                        'rules'     => 'required',
                        'errors'    =>[
                            'required' => '{field} email harus diisi',
                        ]
                    ], 
                    'username'  => [
                        'rules'     => 'required',
                        'errors'    =>[
                            'required' => '{field} username harus diisi',
                        ]
                    ], 
                    'password'  => [
                        'rules'     => 'required',
                        'errors'    =>[
                            'required' => '{field} password harus diisi',
                        ]
                    ], 
                ];
                
                if (!$this->validate($validasi)) {
                    $validation = \Config\Services::validation();

                    $error = [
                        'error_nik' => $validation->getError('nik'),
                        'error_nama_lengkap' => $validation->getError('nama_lengkap'),
                        'error_jabatan' => $validation->getError('jabatan'),
                        'error_alamat' => $validation->getError('alamat'),
                        'error_jenis_kelamin' => $validation->getError('jenis_kelamin'),
                        'error_tempat_lahir' => $validation->getError('tempat_lahir'),
                        'error_tanggal_lahir' => $validation->getError('tanggal_lahir'),
                        'error_agama' => $validation->getError('agama'),
                        'error_pendidikan' => $validation->getError('pendidikan'),
                        'error_no_telp' => $validation->getError('no_telp'),
                        'error_email' => $validation->getError('email'),
                        'error_username' => $validation->getError('username'),
                        'error_password' => $validation->getError('password'),
                    ];
                    $json = [
                        'error' => $error
                    ];
                }else{
                    $modelKaryawan = new KaryawanModel();
                    $modelUser = new UserModel();
                    $data1 = [
                        'id_grup' => 1,
                        'id_divisi' => 1,
                        'nik' => $this->request->getPost('nik'),
                        'jabatan' => $this->request->getPost('jabatan'),
                        'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                        'alamat' => $this->request->getPost('alamat'),
                        'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                        'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                        'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                        'agama' => $this->request->getPost('agama'),
                        'pendidikan' => $this->request->getPost('pendidikan'),
                        'no_telp' => $this->request->getPost('no_telp'),
                        'email' => $this->request->getPost('email'),
                    ];
                    
                    $modelKaryawan->save($data1);

                    $data2 = [
                        'id_karyawan' => $modelKaryawan->getInsertID(),
                        'name' => $this->request->getPost('nama_lengkap'),
                        'email' => $this->request->getPost('email'),
                        'username' => $this->request->getPost('username'),
                        'password_hash' => Password::hash($this->request->getPost('password')),
                    ];
                    $modelUser->save($data2);

                    $json = [
                        'success' => 'Berhasil menambah data karyawan'
                    ];
                }
                echo json_encode($json);
            } else {
                return 'Tidak bisa load';
            }
            
        }


    public function edit($id = null)
    {
        if ($this->request->isAJAX()){
            $modelKaryawan = new KaryawanModel();
            $karyawan      = $modelKaryawan->find($id);

            $data = [
                'karyawan' => $karyawan,
            ];
            $json = [
                'data' => view('data_master/karyawan/edit', $data),
            ];

            echo json_encode($json);
        }else{
            return 'Tidak bisa load';
        }
    }


    public function update($id = null)
    {
        
        $validasi = [
            'nik'  => [
                'rules'     => 'required',
                'errors'    =>[
                    'required' => '{field} nik harus diisi',
                ]
            ],
            'jabatan'  => [
                'rules'     => 'required',
                'errors'    =>[
                    'required' => '{field} jabatan harus diisi',
                ]
            ],
            'nama_lengkap'  => [
                'rules'     => 'required',
                'errors'    =>[
                    'required' => '{field} nama lengkap harus diisi',
                ]
            ],
            'alamat'  => [
                'rules'     => 'required',
                'errors'    =>[
                    'required' => '{field} alamat harus diisi',
                ]
            ],
            'jenis_kelamin'  => [
                    'rules'     => 'required',
                    'errors'    =>[
                        'required' => '{field} jenis kelamin harus diisi',
                ]
            ],
            'tempat_lahir'  => [
                'rules'     => 'required',
                'errors'    =>[
                    'required' => '{field} tempat lahir harus diisi',
                ]
            ],
            'tanggal_lahir'  => [
                'rules'     => 'required',
                'errors'    =>[
                    'required' => '{field} tanggal lahir harus diisi',
                ]
            ],  
            'agama'  => [
                'rules'     => 'required',
                'errors'    =>[
                    'required' => '{field} agama harus diisi',
                ]
            ], 
            'pendidikan'  => [
                'rules'     => 'required',
                'errors'    =>[
                    'required' => '{field} pendidikan harus diisi',
                ]
            ],    
            'no_telp'  => [
                'rules'     => 'required',
                'errors'    =>[
                    'required' => '{field} no telepon harus diisi',
                ]
            ], 
            'email'  => [
                'rules'     => 'required',
                'errors'    =>[
                    'required' => '{field} email harus diisi',
                ]
            ], 
        ];

        if (!$this->validate($validasi)) {
            $validation = \Config\Services::validation();
            
            $error = [
                'error_nik' => $validation->getError('nik'),
                'error_jabatan' => $validation->getError('jabatan'),
                'error_nama_lengkap' => $validation->getError('nama_lengkap'),
                'error_alamat' => $validation->getError('alamat'),
                'error_jenis_kelamin' => $validation->getError('jenis_kelamin'),
                'error_tempat_lahir' => $validation->getError('tempat_lahir'),
                'error_tanggal_lahir' => $validation->getError('tanggal_lahir'),
                'error_agama' => $validation->getError('agama'),
                'error_pendidikan' => $validation->getError('pendidikan'),
                'error_no_telp' => $validation->getError('no_telp'),
                'error_email' => $validation->getError('email'),
            ];
            
            $json = [
                'error' => $error
            ];
            
        }else{
            $modelKaryawan = new KaryawanModel();
            
            $data = [
                'id' => $id,
                'nik' => $this->request->getPost('nik'),
                'jabatan' => $this->request->getPost('jabatan'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'alamat' => $this->request->getPost('alamat'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'agama' => $this->request->getPost('agama'),
                'pendidikan' => $this->request->getPost('pendidikan'),
                'no_telp' => $this->request->getPost('no_telp'),
                'email' => $this->request->getPost('email'),
            ];
            $modelKaryawan->save($data);
            $json = [
                'success' => 'Berhasil Update data karyawan'
            ];
        //}
        }
        echo json_encode($json);
    }


    public function delete($id = null)
    {
        $modelKaryawan = new KaryawanModel();
        $modelUser = new UserModel();

        $modelKaryawan->delete($id);
        $modelUser->where(['id_karyawan'=>$id])->delete();
        

        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/karyawan');
    }
}
