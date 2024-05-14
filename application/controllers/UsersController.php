<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UsersController extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Users');
	}

	public function registerUser($user_data)
	{
		$user_created = $this->Users->registerUser($user_data);
		if ($user_created) {
			echo json_encode(['message' => 'User registered successfully']);
		} else {
			echo json_encode(['error' => 'Failed to register user']);
		}
	}

	public function loginUser($user_data)
	{
		$user = $this->Users->loginUser(json_encode($user_data));

		if ($user) {
			echo json_encode($user);
		} else {
			echo json_encode(['error' => 'Invalid username or password']);
		}
	}

	public function getUser($user_id)
	{
		$user = $this->Users->getUser($user_id);

		if ($user) {
			echo $user;
		} else {
			echo json_encode(['error' => 'User not found']);
		}
	}
}
