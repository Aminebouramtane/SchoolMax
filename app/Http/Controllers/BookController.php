<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Grade;
use App\Http\Traits\MeetingZoomTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Books = Book::all();
        $grades = Grade::all();
        return view('Pages.library.index',compact('Books','grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
     public function uploadFile($request,$name)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/library/',$file_name,'upload_attachments');
    }
    public function deleteFile($name)
    {
        $exists = Storage::disk('upload_attachments')->exists('attachments/library/'.$name);

        if($exists)
        {
            Storage::disk('upload_attachments')->delete('attachments/library/'.$name);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $books = new Book();
            $books->title = $request->title;
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->grade_id = $request->grade_id;
            $books->classe_id = $request->classe_id;
            $books->section_id = $request->section_id;
            $books->teacher_id = 1;
            $this->uploadFile($request,'file_name');
            $books->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {

        $book = Book::findorFail($id);
        $book->title = $request->title;

        if($request->hasfile('file_name')){

            $this->deleteFile($book->file_name);

            $this->uploadFile($request,'file_name');

            $file_name_new = $request->file('file_name')->getClientOriginalName();
            $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
        }

        $book->grade_id = $request->grade_id;
        $book->classe_id = $request->classe_id;
        $book->section_id = $request->section_id;
        $book->teacher_id = 1;
        $book->save();
        toastr()->success(trans('messages.Update'));
        return redirect()->route('library.index');
        } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        $this->deleteFile($request->file_name);
        Book::destroy($id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('library.index');
    }

    public function download($filename)
    {
        return response()->download(public_path('attachments/library/'.$filename));
    }
}
