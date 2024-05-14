<?php

class Quiz_Results extends CI_Model
{
	public $result_id;
	public $quiz_id;
	public $user_id;
	public $score;
	public $is_complete;

	public function __construct()
	{
		parent::__construct();
	}

	public function getResultsHistory($user_id = null, $quiz_id = null)
	{
		$this->db->select('*');
		$this->db->from('Quiz_Results');

		$where = [];
		if ($user_id !== null) {
			$where['user_id'] = $user_id;
		}
		if ($quiz_id !== null) {
			$where['quiz_id'] = $quiz_id;
		}

		if ($where) {
			$this->db->where($where);
		}

		$query = $this->db->get();
		$results = $query->result_array();

		return $results;
	}
}
