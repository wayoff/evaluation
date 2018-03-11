<?php

use App\Question;

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            'Discusses the course outline of syllabus at the start of the term',
            "Comes to class prepared for the day's lessong",
            'Discuss the lessongs in a well-organized manner',
            'Is well informed of current trends and encourage students to keep up with recent and varied publication related to the subject',
            'Related the lessons to everyday experience',
            'Is fluent in the use of language ( English, Filipino, etc)',
            'Diversifies his/her teaching method to make the teaching experience more effective',
            'Maintain discipline and yet establishes a friendly atmosphere in the classroom',
            "Encourage students to make independent study habit and check homework's regularly",
            'Encourages questions and discussions in the classroom',
            'Shows fairness and impartiality',
            'Shows interest and concern for the welfare of the students',
            'Allows student to express their opinion',
            'Give test that cover important lessons assigned or taken up in class',
            'Discuss test results and problem areas',
        ];

        $answers = [
            'Always', 'Often', 'Sometimes', 'Seldom', 'Never'
        ];

        foreach($questions as $value) {

            $question = Question::create([
                'title' => $value,
                'description' => $value
            ]);

            foreach ($answers as $key => $answer) {
                $question->choices()->create([
                    'decription' => $answer,
                    'order' => $key + 1
                ]);
            }
        }

    }
}
