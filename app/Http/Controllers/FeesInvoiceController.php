<?php

namespace App\Http\Controllers;

use App\Models\Fees_invoice;
use App\Models\Students_acound;
use App\Models\Grade;
use App\Models\Classe;
use App\Models\Student;
use App\Models\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $Student = Student::find($id);
        // $Grades = Grade::all();
        // $Classes = Classe::all();
        // return view("Pages.fees.fees_invoice",compact("Grades","Classes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $List_Fees = $request->List_Fees;

        DB::beginTransaction();

        try {

            foreach ($List_Fees as $List_Fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $Fees = new Fees_invoice();
                $Fees->date_invoice = date('Y-m-d');
                $Fees->student_id = $List_Fee['student_id'];
                $Fees->grade_id = $request->grade_id;
                $Fees->classe_id = $request->classe_id;;
                $Fees->fees_id = $List_Fee['fees_id'];
                $Fees->amount = $List_Fee['amount'];
                $Fees->description = $List_Fee['description'];
                $Fees->save();

                // حفظ البيانات في جدول حسابات الطلاب
                $StudentAccount = new Students_acound();
                $StudentAccount->date = date('Y-m-d');
                $StudentAccount->type = "invoice";
                $StudentAccount->fees_invoice_id = $Fees->id;
                $StudentAccount->student_id = $List_Fee['student_id'];
                $StudentAccount->Debit = $List_Fee['amount'];
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $List_Fee['description'];
                $StudentAccount->save();
            }

            DB::commit();

            toastr()->success(trans('messages.success'));
            return redirect()->route('fees_invoices.show');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $Students = Student::findOrFail($id);
    //     $fees = Fee::where('classe_id',$Students->classe_id)->get();
    //     $Grades = Grade::all();
    //     $Classes = Classe::all();
    //     return view("Pages.fees.fees_invoice",compact("Grades","Classes","fees","Students"));
    // }
    public function show($id)
    {
        $Students = Student::findOrFail($id);
        $Fees = Fee::where('classe_id', $Students->classe_id)->get();
        $Fees_invoices = Fees_invoice::all();
        $Grades = Grade::all();
        $Classes = Classe::all();
        return view("Pages.fees.fees_invoice", compact("Grades", "Classes", "Fees", "Students","Fees_invoices"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fees_invoice $fees_invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $Fees =Fees_invoice::find($id);
            $Fees->fees_id =$request->fees_id ;
            $Fees->amount = $request->amount;
            $Fees->description = $request->description;
            $Fees->save();
            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = Students_acound::where('fees_invoice_id',$id)->first();
            $StudentAccount->Debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();
            DB::commit();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('fees_invoice.show');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $fees_inv=Fees_invoice::find($id);
            $fees_inv->delete();
            toastr()->error(trans('data has been Deleted'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
