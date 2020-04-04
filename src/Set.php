<?php

/*
 * This file is part of the Certificationy library.
 *
 * (c) Vincent Composieux <vincent.composieux@gmail.com>
 * (c) Mickaël Andrieu <andrieu.travail@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CPANA\Quiz;

use CPANA\Quiz\Collections\Answers;
use CPANA\Quiz\Collections\Questions;
use CPANA\Quiz\Collections\UserAnswers;
use CPANA\Quiz\Interfaces\QuestionInterface;
use CPANA\Quiz\Interfaces\UserAnswerInterface;
use CPANA\Quiz\Interfaces\SetInterface;

class Set implements SetInterface
{
    /**
     * @var Questions
     */
    protected $questions;

    /**
     * @var Answers
     */
    protected $answers;

    public function __construct(Questions $questions)
    {
        $this->questions = $questions;
        $this->answers = new UserAnswers();
    }

    /**
     * @inheritdoc
     */
    public function getQuestion(int $key) : QuestionInterface
    {
        return $this->questions->get($key);
    }

    /**
     * @inheritdoc
     */
    public function getQuestions() : Questions
    {
        return $this->questions;
    }

    /**
     * @inheritdoc
     */
    public function setUserAnswers(int $questionKey, array $answers) : SetInterface
    {
        $this->answers->addAnswers($questionKey, $answers);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getQuestionAnswers(int $key) : Answers
    {
        return $this->question->getAnswers()->get($key);
    }

    /**
     * @inheritdoc
     */
    public function getAnswer(int $questionKey) : UserAnswerInterface
    {
        return $this->answers->get($questionKey);
    }

    /**
     * @inheritdoc
     */
    public function getAnswers() : UserAnswers
    {
        return $this->answers;
    }

    /**
     * @inheritdoc
     */
    public function isCorrect(int $key) : bool
    {
        $question = $this->questions->get($key);
        $answers  = $this->getAnswers()->getAnswersValues($key);

        return $question->areCorrectAnswers($answers);
    }

    /**
     * @inheritdoc
     */
    public function getCorrectAnswers() : Questions
    {
        $questions = new Questions();

        foreach ($this->getQuestions()->all() as $key => $question) {
            $question = $this->getQuestion($key);
            $answers  =  $this->getAnswers()->getAnswersValues($key);

            if ($question->areCorrectAnswers($answers)) {
                $questions->add($key, $question);
            }
        }

        return $questions;
    }

    /**
     * @inheritdoc
     */
    public function getWrongAnswers() : Questions
    {
        $questions = new Questions();

        foreach ($this->getQuestions()->all() as $key => $question) {
            $question = $this->getQuestion($key);
            $answers  = $this->answers->getAnswersValues($key);

            if (!$question->areCorrectAnswers($answers)) {
                $questions->add($key, $question);
            }
        }

        return $questions;
    }

    public static function create(Questions $questions) : self
    {
        return new self($questions);
    }
}
