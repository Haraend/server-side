<?php

class Quiz extends CI_Model
{
	public $quiz_id;
	public $title;
	public $user_id;
	public $description;
	public $is_published;

	public function __construct()
	{
		parent::__construct();
	}

	public function createQuiz($data)
	{
		// decode json
		$quiz_data = json_decode($data, true);

		if (!$quiz_data) {
			return false; // if json invalid
		}

		$this->title = $quiz_data['title'];
		$this->user_id = $quiz_data['user_id'];
		$this->description = $quiz_data['description'];
		$this->is_published = $quiz_data['is_published'];

		$this->db->insert('quiz', $this);

		return $this->db->affected_rows() > 0;
	}

	public function deleteQuiz($quiz_id)
	{
		$this->db->where('quiz_id', $quiz_id);
		$this->db->delete('quiz');

		// Check for successful deletion (This might need adjustment based on your database)
		return $this->db->affected_rows() > 0;
	}

	public function getQuiz($quiz_id)
	{
		$this->db->where('quiz_id', $quiz_id);
		$query = $this->db->get('quiz');

		$quiz = $query->row_array();

		// return json if found or return false
		return $quiz ? json_encode($quiz) : false;
	}
}
