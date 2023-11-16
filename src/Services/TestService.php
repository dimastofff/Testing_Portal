<?php

namespace App\Services;

use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use App\Repositories\EntityRepository;

class TestService
{
    public static function createTest(int $idAuthor, string $name, array $questions): int
    {
        try {
            $GLOBALS['PDO_CONNECTION']->beginTransaction();
            $test = new Test();
            $test->setIdAuthor($idAuthor);
            $test->setName($name);
            $testId = EntityRepository::save($test);
            foreach ($questions as $questionData) {
                $question = new Question();
                $question->setIdTest($testId);
                $question->setName($questionData['questionName']);
                $questionId = EntityRepository::save($question);
                foreach ($questionData['answers'] as $index => $answerName) {
                    $answer = new Answer();
                    $answer->setName($answerName);
                    $answer->setIdQuestion($questionId);
                    $answerId = EntityRepository::save($answer);
                    if ($index == $questionData['correctAnswerIndex']) {
                        $question->setIdCorrectAnswer($answerId);
                        EntityRepository::update($question, ['WHERE' => ['id' => $questionId]]);
                    }
                }
            }
            $GLOBALS['PDO_CONNECTION']->commit();
            return $testId;
        } catch (\Exception $e) {
            $GLOBALS['PDO_CONNECTION']->rollback();
            throw new \Exception($e->getMessage());
        }
    }
}
