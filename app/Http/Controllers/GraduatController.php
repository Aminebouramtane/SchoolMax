<?php

namespace App\Http\Controllers;

use App\Models\Graduat;
use Illuminate\Http\Request;
use App\Repository\GraduatRepositoryInterface;

class GraduatController extends Controller
{
    private $graduat;
    public function __construct(GraduatRepositoryInterface $graduat)
    {
        $this->graduat = $graduat;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->graduat->getGraduat();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->graduat->createGraduat();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->graduat->SoftDelete($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Graduat $graduat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Graduat $graduat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Graduat $graduat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {

        if($request->page_id ==1){
            return $this->graduat->Restore($request);
        }elseif($request->page_id ==2){
            return $this->graduat->RestoreAll();
        }else{
            return $this->graduat->destroy($id);
        }
    }
}
