<?php

class Quiz_Answer extends CI_Model

{
	public $quiz_answer_id;
	public $quiz_question_id;
	public $user_id;
	public $answer_content;

	public function __construct()
	{
		parent::__construct();
	}

	public function createQuizAnswer($data)
	{
		$answer_data = json_decode($data, true);

		if (!$answer_data) {
			return false;
		}

		$this->quiz_question_id = $answer_data['quiz_question_id'];
		$this->user_id = $answer_data['user_id'];
		$this->answer_content = $answer_data['answer_content'];

		$this->db->insert('quiz_answer', $this);

		return $this->db->affected_rows() > 0;
	}

	public function getQuizAnswer($quiz_question_id, $user_id)
	{
		$this->db->where('quiz_question_id', $quiz_question_id);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('quiz_answer');

		$answer = $query->row_array();

		return json_encode($answer) ? $answer : false;
	}

	public function deleteQuizAnswer($quiz_answer_id)
	{
		$this->db->where('quiz_answer_id', $quiz_answer_id);
		$this->db->delete('quiz_answer');

		return $this->db->affected_rows() > 0;
	}
}
