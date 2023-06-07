<?php

namespace App\Http\Controllers;

use App\Models\Receipt_student;
use App\Models\Fund_account;
use App\Models\Students_acound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
        
        DB::beginTransaction();

        try {

            // حفظ البيانات في جدول سندات القبض
            $receipt_students = new Receipt_student();
            $receipt_students->date = date('Y-m-d');
            $receipt_students->student_id = $request->student_id;
            $receipt_students->Debit = $request->debit;
            $receipt_students->description = $request->description;
            $receipt_students->save();

            // حفظ البيانات في جدول الصندوق
            $fund_accounts = new Fund_account();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->Debit = $request->debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            // حفظ البيانات في جدول حساب الطالب
            $fund_accounts = new Students_acound();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->type = 'receipt';
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->student_id = $request->student_id;
            $fund_accounts->debit = 0.00;
            $fund_accounts->credit = $request->debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('receipt_students.show');

        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Reciept = Receipt_student::all();
        $Ids = $id ; 
        return view("Pages.fees.reciept",compact("Reciept","Ids"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receipt_student $receipt_student)
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
            // تعديل البيانات في جدول سندات القبض
            $receipt_students = Receipt_student::findorfail($id);
            $receipt_students->date = date('Y-m-d');
            $receipt_students->student_id = $request->student_id;
            $receipt_students->Debit = $request->debit;
            $receipt_students->description = $request->description;
            $receipt_students->save();

            // تعديل البيانات في جدول الصندوق
            $fund_accounts = Fund_account::where('receipt_id',$id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->Debit = $request->debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            // تعديل البيانات في جدول الصندوق

            $fund_accounts = Students_acound::where('receipt_id',$id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->type = 'receipt';
            $fund_accounts->student_id = $request->student_id;
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->debit = 0.00;
            $fund_accounts->credit = $request->debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();


            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('receipt_students.show');
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
            Receipt_student::destroy($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
