<?php

class Quiz_Questions extends CI_Model
{
	public $question_id;
	public $quiz_id;
	public $quiz_type_id;
	public $question_content;
	public $question_answer;

	public function __construct()
	{
		parent::__construct();
	}

	public function createQuizQuestion($data)
	{
		$question_data = json_decode($data, true);

		if (!$question_data) {
			return false;
		}

		$this->quiz_id = $question_data['quiz_id'];
		$this->quiz_type_id = $question_data['quiz_type_id'];
		$this->question_content = $question_data['question_content'];
		$this->question_answer = $question_data['question_answer'];

		$this->db->insert('quiz_questions', $this);

		return $this->db->affected_rows() > 0;
	}

	public function getQuizQuestions($quiz_id)
	{
		$this->db->where('quiz_id', $quiz_id);
		$query = $this->db->get('quiz_questions');

		$questions = $query->result_array();

		return json_encode($questions) ? $questions : false;
	}

	public function deleteQuizQuestion($question_id)
	{
		$this->db->where('question_id', $question_id);
		$this->db->delete('quiz_questions');

		return $this->db->affected_rows() > 0;
	}
}
