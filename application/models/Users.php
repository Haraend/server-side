<?php

class Users extends CI_Model
{
	public $user_id;
	public $first_name;
	public $last_name;
	public $username;
	public $email;
	public $password;

	public function __construct()
	{
		parent::__construct();
	}

	public function registerUser($data)
	{
		// decode json
		$user_data = json_decode($data, true);

		if (!$user_data) {
			return false; // if json invalid
		}

		$this->first_name = $user_data['first_name'];
		$this->last_name = $user_data['last_name'];
		$this->username = $user_data['username'];
		$this->email = $user_data['email'];
		$this->password = md5($user_data['password']); // hash password using md5

		$this->db->insert('Users', $this);

		// Check if database updated and return true
		return $this->db->affected_rows() > 0;
	}

	public function loginUser($data)
	{
		// decode json
		$user_data = json_decode($data, true);

		if (!$user_data) {
			return false; // if json invalid
		}

		$username = $user_data['username'];
		$password = md5($user_data['password']);

		// query db for matching values
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('users');

		$user = $query->row_array();

		// return true if user found or return false
		return $user ? $user : false;
	}

	public function getUser($user_id)
	{
		// query db for matching values
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('users');

		$user = $query->row_array();

		// return true if user as json or return false
		return $user ? json_encode($user) : false;
	}
}
