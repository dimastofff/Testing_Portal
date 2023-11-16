<?php

namespace App\Controllers;

use App\Utils\Router;
use App\Services\TestService;

class TestsController
{
    public function createTest(array $data): void
    {
        try {
            $testName = $data['test-name'];

            if (strlen($testName) < 4 || strlen($testName) > 255) {
                $GLOBALS['LOGGER']->error('Incorrect form data for test creating: "' . $testName . '"');
                Router::redirectWithAlert('danger', 'Form data incorrect.', '/tests/create_test');
            }

            $questions = [];

            for ($questionIndex = 1; $questionIndex <= (count($data) - 1) / 6; $questionIndex++) {
                $question = [];
                $question['questionName'] = $data['question-name-' . $questionIndex];
                $question['correctAnswerIndex'] = $data['correct-answer-' . $questionIndex];

                if (empty($question['questionName']) || empty($question['correctAnswerIndex'])) {
                    $GLOBALS['LOGGER']->error('Incorrect form data for test creating: "' . $testName . '"');
                    Router::redirectWithAlert('danger', 'Form data incorrect.', '/tests/create_test');
                }

                $question['answers'] = [];
                for ($answerIndex = 1; $answerIndex <= 4; $answerIndex++) {
                    if (empty($data['answer-name-' . $questionIndex . '-' . $answerIndex])) {
                        $GLOBALS['LOGGER']->error('Incorrect form data for test creating: "' . $testName . '"');
                        Router::redirectWithAlert('danger', 'Form data incorrect.', '/tests/create_test');
                    }

                    array_push($question['answers'], $data['answer-name-' . $questionIndex . '-' . $answerIndex]);
                }
                array_push($questions, $question);
            }

            if (TestService::createTest($_SESSION['user']['id'], $testName, $questions)) {
                $GLOBALS['LOGGER']->info('Successfull test creation: "' . $testName . '"');
                Router::redirectWithAlert('success', 'Successfull test creation.', '/tests');
            }
        } catch (\Exception $e) {
            $GLOBALS['LOGGER']->error($e->getMessage());
            Router::redirectWithAlert('danger', 'Creation test unsuccessfull', '/tests/create_test');
        }
    }
}
