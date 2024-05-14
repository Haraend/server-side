<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMapFromDumps(array (
  'default' => 
  array (
    'tablesByName' => 
    array (
      'quiz' => '\\definitions\\Map\\QuizTableMap',
      'quiz_answer' => '\\definitions\\Map\\QuizAnswerTableMap',
      'quiz_questions' => '\\definitions\\Map\\QuizQuestionsTableMap',
      'quiz_results' => '\\definitions\\Map\\QuizResultsTableMap',
      'quiz_type' => '\\definitions\\Map\\QuizTypeTableMap',
      'users' => '\\definitions\\Map\\UsersTableMap',
    ),
    'tablesByPhpName' => 
    array (
      '\\Quiz' => '\\definitions\\Map\\QuizTableMap',
      '\\QuizAnswer' => '\\definitions\\Map\\QuizAnswerTableMap',
      '\\QuizQuestions' => '\\definitions\\Map\\QuizQuestionsTableMap',
      '\\QuizResults' => '\\definitions\\Map\\QuizResultsTableMap',
      '\\QuizType' => '\\definitions\\Map\\QuizTypeTableMap',
      '\\Users' => '\\definitions\\Map\\UsersTableMap',
    ),
  ),
));
