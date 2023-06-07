<?php

namespace App\Http\Livewire;
use App\Models\Question;
use App\Models\Degree;

use Livewire\Component;

class ShosQuestion extends Component
{
    public $exam_id,$student_id,$data,$counter=0,$questioncount=1;


    public function render()
    {
        $this->data = Question::where("exam_id",$this->exam_id)->get();
        $this->questioncount = $this->data->count();
        return view('livewire.shos-question',['data']);
    }

    public function nextQuestion($question_id,$score,$answer,$right_answer){
        // dd($qustion_id,$score,$answer,$right_answer);
        $stuDegree = Degree::where('student_id', $this->student_id)
            ->where('exam_id', $this->exam_id)
            ->first();
        // insert
        if ($stuDegree == null) {
            $degree = new Degree();
            $degree->exam_id = $this->exam_id;
            $degree->student_id = $this->student_id;
            $degree->question_id = $question_id;
            if (strcmp(trim($answer), trim($right_answer)) === 0) {
                $degree->score += $score;
            } else {
                $degree->score += 0;
            }
            $degree->date = date('Y-m-d');
            $degree->save();
         }
        else {

            // update
            if ($stuDegree->question_id >= $this->data[$this->counter]->id) {
                $stuDegree->score = 0;
                $stuDegree->abuse = '1';
                $stuDegree->save();
                toastr()->error(trans('dashboards.errorquestion'));
                return redirect('examstudents');
            } else {

                $stuDegree->question_id = $question_id;
                if (strcmp(trim($answer), trim($right_answer)) === 0) {
                    $stuDegree->score += $score;
                } else {
                    $stuDegree->score += 0;
                }
                $stuDegree->save();
            }
        }

        if ($this->counter < $this->questioncount - 1) {
            $this->counter++;
        } else {
            toastr()->success(trans('questions.successexam'));
            return redirect('examstudents');
        }

    }

}
