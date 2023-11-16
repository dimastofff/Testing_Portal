<?php
use App\Utils\Page;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= Page::part('common_head'); ?>
    <title>Create test</title>
    <style>
        .answer-container {
            display: flex;
        }

        .answer-container>* {
            margin: auto 10px;
        }
    </style>
</head>

<body>
    <?= Page::part('header'); ?>
    <main class="container my-4 w-50">
        <h2 class="text-center">Create test</h2>
        <form class="my-4" method="post" action="/tests/create">
            <div class="mb-3">
                <label for="test-name" class="form-label">Test name</label>
                <input type="text" class="form-control" id="test-name" name="test-name" minlength="4" maxlength="255"
                    required>
            </div>
            <button type="button" id="add-question" class="btn btn-success">
                Add
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-question" viewBox="0 0 16 16">
                    <path
                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                </svg>
            </button>
            <div class="accordion my-4" id="questions-container">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#question-1" aria-expanded="true" aria-controls="question-1">
                            Question № 1
                        </button>
                    </h2>
                    <div id="question-1" class="accordion-collapse collapse show" data-bs-parent="#questions-container">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <label for="question-name-1" class="form-label">Question name</label>
                                <input type="text" class="form-control" id="question-name-1" name="question-name-1"
                                    minlength="1" maxlength="3000" required>
                            </div>
                            <label class="form-label">Answers</label>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item answer-container">
                                    <input class="form-check-input" type="radio" name="correct-answer-1"
                                        id="correct-answer-1-1" value="0" required>
                                    <input type="text" class="form-control" id="answer-name-1-1" name="answer-name-1-1"
                                        minlength="1" maxlength="3000" required>
                                </li>
                                <li class="list-group-item answer-container">
                                    <input class="form-check-input" type="radio" name="correct-answer-1"
                                        id="correct-answer-1-2" value="1">
                                    <input type="text" class="form-control" id="answer-name-1-2" name="answer-name-1-2"
                                        minlength="1" maxlength="3000" required>
                                </li>
                                <li class="list-group-item answer-container">
                                    <input class="form-check-input" type="radio" name="correct-answer-1"
                                        id="correct-answer-1-3" value="2">
                                    <input type="text" class="form-control" id="answer-name-1-3" name="answer-name-1-3"
                                        minlength="1" maxlength="3000" required>
                                </li>
                                <li class="list-group-item answer-container">
                                    <input class="form-check-input" type="radio" name="correct-answer-1"
                                        id="correct-answer-1-4" value="3">
                                    <input type="text" class="form-control" id="answer-name-1-4" name="answer-name-1-4"
                                        minlength="1" maxlength="3000" required>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create test</button>
        </form>
    </main>
    <script type="text/javascript">
        let nextQuestionIndex = 2;
        $("button#add-question").on("click", () => {
            $("div#questions-container").append(`
            <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#question-${nextQuestionIndex}" aria-expanded="false" aria-controls="question-${nextQuestionIndex}">
                            Question № ${nextQuestionIndex}
                        </button>
                    </h2>
                    <div id="question-${nextQuestionIndex}" class="accordion-collapse collapse" data-bs-parent="#questions-container">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <label for="question-name-${nextQuestionIndex}" class="form-label">Question name</label>
                                <input type="text" class="form-control" id="question-name-${nextQuestionIndex}" name="question-name-${nextQuestionIndex}"
                                    minlength="1" maxlength="3000" required>
                            </div>
                            <label class="form-label">Answers</label>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item answer-container">
                                    <input class="form-check-input" type="radio" name="correct-answer-${nextQuestionIndex}"
                                        id="correct-answer-${nextQuestionIndex}-1" value="0" required>
                                    <input type="text" class="form-control" id="answer-name-${nextQuestionIndex}-1" name="answer-name-${nextQuestionIndex}-1"
                                        minlength="1" maxlength="3000" required>
                                </li>
                                <li class="list-group-item answer-container">
                                    <input class="form-check-input" type="radio" name="correct-answer-${nextQuestionIndex}"
                                        id="correct-answer-${nextQuestionIndex}-2" value="1">
                                    <input type="text" class="form-control" id="answer-name-${nextQuestionIndex}-2" name="answer-name-${nextQuestionIndex}-2"
                                        minlength="1" maxlength="3000" required>
                                </li>
                                <li class="list-group-item answer-container">
                                    <input class="form-check-input" type="radio" name="correct-answer-${nextQuestionIndex}"
                                        id="correct-answer-${nextQuestionIndex}-3" value="2">
                                    <input type="text" class="form-control" id="answer-name-${nextQuestionIndex}-3" name="answer-name-${nextQuestionIndex}-3"
                                        minlength="1" maxlength="3000" required>
                                </li>
                                <li class="list-group-item answer-container">
                                    <input class="form-check-input" type="radio" name="correct-answer-${nextQuestionIndex}"
                                        id="correct-answer-${nextQuestionIndex}-4" value="3">
                                    <input type="text" class="form-control" id="answer-name-${nextQuestionIndex}-4" name="answer-name-${nextQuestionIndex}-4"
                                        minlength="1" maxlength="3000" required>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                `);
            $(`button[data-bs-target="\#question-${nextQuestionIndex}"]`).click();
            nextQuestionIndex++;
        });

    </script>
</body>

</html>