<?php

namespace App\Controllers;

use App\Models\JemaahModel;
use App\Models\UserModel;

class Auth extends BaseController
{
	protected $userModel;
	protected $jemaahModel;

	public function __construct()
	{
		$this->userModel = new UserModel();
		$this->jemaahModel = new JemaahModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Login',
			'validation' => \Config\Services::validation()
		];
		return view('auth/login', $data);
	}

	public function registration()
	{
		// return view('welcome_message');
		$data = [
			'title' => 'Registration',
			'validation' => \Config\Services::validation()
		];
		return view('auth/registration', $data);
	}

	public function register()
	{
		if (!$this->validate([
			'name' => [
				'label'  => 'Name',
				'rules' => 'required',
			],

			'email' => [
				'label'  => 'Email',
				'rules' => 'required|valid_email|is_unique[user.email]',
				'errors' => [
					'is_unique' => 'This Email has already registered.'
				]
			],

			'password1' => [
				'label'  => 'Password',
				'rules' => 'required|min_length[3]|matches[password2]',
				'errors' => [
					'matches' => 'Password dont match.',
					'min_length' => 'Password too short.',
				]
			],

			'password2' => [
				'label'  => 'Repeat Password',
				'rules' => 'required|matches[password1]'
			]

		])) {

			// $validation = \Config\Services::validation();

			// return redirect()->to('/product/create')->withInput()->with('validation', $validation);
			return redirect()->to('/auth/registration')->withInput();
		}

		$this->userModel->save([
			'name' => htmlspecialchars($this->request->getVar('name')),
			'email' => htmlspecialchars($this->request->getVar('email')),
			'image' => 'defaultUser.jpg',
			'password' => password_hash($this->request->getVar('password1'), PASSWORD_DEFAULT),
			'role_id' => 3,
			'is_active' => 0
		]);

		session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Congratulation! Your account has been created. Please login');

		return redirect()->to('/auth');
	}

	public function login()
	{

		if (!$this->validate([
			'email' => [
				'label'  => 'Email',
				'rules' => 'required|valid_email'
			],

			'password' => [
				'label'  => 'Password',
				'rules' => 'required'
			]

		])) {

			// $validation = \Config\Services::validation();

			// return redirect()->to('/product/create')->withInput()->with('validation', $validation);
			return redirect()->to('/auth')->withInput();
		}

		// KETIKA VALIDASI SUKSES
		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');

		$user = $this->userModel->where(['email' => $email])->first();

		// user ada
		if ($user) {

			// jika user aktiv
			if ($user['is_active'] == 1 && $user['role_id'] != 3) {

				// cek password
				if (password_verify($password, $user['password'])) {
					$data = [
						'name' => $user['name'],
						'email' => $user['email'],
						'image' => $user['image'],
						'role_id' => $user['role_id']
					];

					// $data = [
					// 	'status' => 'berhasil',
					// 	'user' => [
					// 		'name' => $user['name'],
					// 		'email' => $user['email'],
					// 		'image' => $user['image'],
					// 		'role_id' => $user['role_id']
					// 	]
					// ];

					// return $json = json_encode($data);

					session()->set($data);

					if ($user['role_id'] == 1) {

						return redirect()->to('/home');
						

					} else {
						return redirect()->to('/jemaah/haji');
					}
				} else {
					session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Worng password!');
					return redirect()->to('/auth');
				}
			} else {
				session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">your account is not granted access rights!');

				return redirect()->to('/auth');
			}
		} else {

			session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Email is not registered!');

			return redirect()->to('/auth');
		}
	}

	public function logout()
	{
		session()->remove('email');
		session()->remove('role_id');
		session()->remove('image');
		session()->remove('name');

		session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">You have been logged out!');
		return redirect()->to('/auth');
	}

	//--------------------------------------------------------------------

	public function apiregister()
	{
		if (!$this->validate([
			'name' => [
				'label'  => 'Name',
				'rules' => 'required',
			],

			'email' => [
				'label'  => 'Email',
				'rules' => 'required|valid_email|is_unique[user.email]',
				'errors' => [
					'is_unique' => 'This Email has already registered.'
				]
			],

			'password1' => [
				'label'  => 'Password',
				'rules' => 'required|min_length[3]|matches[password2]',
				'errors' => [
					'matches' => 'Password dont match.',
					'min_length' => 'Password too short.',
				]
			],

			'password2' => [
				'label'  => 'Repeat Password',
				'rules' => 'required|matches[password1]'
			]

		])) {

			// $validation = \Config\Services::validation();

			// return redirect()->to('/product/create')->withInput()->with('validation', $validation);
			// return redirect()->to('/auth/registration')->withInput();
			$validation = \Config\Services::validation();
			
			$data = [
				'status' => 400,
				'error' => 400,
				'messages' => $validation->getErrors()
				
			];
			return json_encode($data);
			// return json_encode($validation->getErrors());
		}

		$this->userModel->save([
			'name' => htmlspecialchars($this->request->getVar('name')),
			'email' => htmlspecialchars($this->request->getVar('email')),
			'image' => 'defaultUser.jpg',
			'password' => password_hash($this->request->getVar('password1'), PASSWORD_DEFAULT),
			'role_id' => 3,
			'is_active' => 1
		]);

		$data = [
			'status' => 'ok',
			'data' => $this->request->getVar()
			
		];

		return $json = json_encode($data);
	}


	public function apilogin()
	{

		if (!$this->validate([
			'email' => [
				'label'  => 'Email',
				'rules' => 'required|valid_email'
			],

			'password' => [
				'label'  => 'Password',
				'rules' => 'required'
			]

		])) {

			$validation = \Config\Services::validation();
				
			// return json_encode($validation->getErrors());
			$data = [
				'status' => 400,
				'error' => 400,
				'messages' => $validation->getErrors()
				
			];
			return json_encode($data);
		}

		// KETIKA VALIDASI SUKSES
		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');

		$user = $this->userModel->where(['email' => $email])->first();

		// user ada
		if ($user) {

			// jika user aktiv
			if ($user['is_active'] == 1) {

				// cek password
				if (password_verify($password, $user['password'])) {
					
					$jemaah = $this->jemaahModel->cekEmail($user['email']);

					$idJemaah = null;

					if($jemaah){
						$idJemaah = $jemaah['idJemaah'];
					}

					$data = [
						'status' => 'ok',
						'data' => [
							'idJemaah' => $idJemaah,
							'name' => $user['name'],
							'email' => $user['email'],
							'image' => $user['image'],
							'role_id' => $user['role_id']
						]
					];

					return json_encode($data);

				} else {
					$data = [
						'status' => 400,
						'error' => 400,
						'messages' => [
							'password' => 'Worng password!'
						]
					];
					return json_encode($data);
				}
			} else {
				$data = [
					'status' => 400,
					'error' => 400,
					'messages' => [
						'email' => 'your account is not granted access rights!'
					]
					
				];
				return json_encode($data);
			}
		} else {

			$data = [
				'status' => 400,
				'error' => 400,
				'messages' => [
					'email' => 'Email is not registered!'
				]
				
			];
			return json_encode($data);
		}
	}

}
