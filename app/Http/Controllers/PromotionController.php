<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Repository\PromotionRepositoryInterface;

class PromotionController extends Controller
{

    private $promotion;
    public function __construct(PromotionRepositoryInterface $promotion)
    {
        $this->promotion = $promotion;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->promotion->ListPromotion();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->promotion->getPromotion();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->promotion->StorePromotion($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        return $this->promotion->rollback($request,$id);
    }
}
