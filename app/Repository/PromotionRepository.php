<?php

namespace App\Repository;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Classe;
use App\Models\Section;
use App\Models\Promotion;



class PromotionRepository implements PromotionRepositoryInterface
{

    public function getPromotion(){
        $grades = Grade::all();
        return view("Pages.students.promotions.add_promotion",compact("grades"));
    }
    public function StorePromotion($request){
        DB::beginTransaction();

        try {

            $students = Student::where('grade_id',$request->grade_id)->where('classe_id',$request->classe_id)->where('section_id',$request->section_id)->where('season',$request->season)->get();

            if($students->count() < 1){
                return redirect()->back()->with('error_promotions', __('No student to upgrade'));
            }

            // update in table student
            foreach ($students as $student){

                $ids = explode(',',$student->id);
                student::whereIn('id', $ids)
                    ->update([
                        'grade_id'=>$request->new_grade_id,
                        'classe_id'=>$request->new_classe_id,
                        'section_id'=>$request->new_section_id,
                        'season'=>$request->new_season,
                    ]);

                // insert in to promotions
                Promotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->grade_id,
                    'from_classe'=>$request->classe_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->new_grade_id,
                    'to_classe'=>$request->new_classe_id,
                    'to_section'=>$request->new_section_id,
                    'season'=>$request->season,
                    'new_season'=>$request->new_season,
                ]);

            }
            DB::commit();
            toastr()->success(trans('Student Upgrated ...'));
            return redirect()->route("promotions.index");

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function ListPromotion(){
        $Promotions = Promotion::all();
        return view("Pages.students.promotions.list_promotion",compact("Promotions"));
    }

    public function rollback($request,$id)
    {
        DB::beginTransaction();

        try {

            if($request->page_id ==1){

             $Promotions = Promotion::all();
             foreach ($Promotions as $Promotion){

                 $ids = explode(',',$Promotion->student_id);
                 Student::whereIn('id', $ids)
                 ->update([
                 'grade_id'=>$Promotion->from_grade,
                 'classe_id'=>$Promotion->from_classe,
                 'section_id'=> $Promotion->from_section,
                 'season'=> $Promotion->season,
               ]);
                 Promotion::truncate();

             }
                DB::commit();
                toastr()->success("Action has completed succussfully");
                return redirect()->back();


            }else{
                $Promotions = Promotion::find($id);
                Student::where('id', $Promotions->student_id)
                 ->update([
                 'grade_id'=>$Promotions->from_grade,
                 'classe_id'=>$Promotions->from_classe,
                 'section_id'=> $Promotions->from_section,
                 'season'=> $Promotions->season,
               ]);
               
               $Promotions->destroy($id);
               DB::commit();
               toastr()->success("Action has completed succussfully");
                return redirect()->back();
            }


        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}