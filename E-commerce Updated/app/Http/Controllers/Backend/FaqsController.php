<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FaqDataTable;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FaqDataTable $dataTable)
    {
        return $dataTable->render('Staff.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Staff.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> ['required'],
            'description' => ['required'],
        ]);

        $faq = new Faq();

        $faq->title = $request->title;
        $faq->description = $request->description;
        $faq->save();


        toastr('Created Successfully', 'success', 'Success');
        return redirect()->route('faq.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = Faq::findOrFail($id);
        return view('Staff.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
        ]);

        $faq = Faq::findOrFail($id);

        $faq->title = $request->title;
        $faq->description = $request->description;
        $faq->save();

        toastr('Updated Successfully', 'success', 'Success');

        return redirect()->route('faq.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
