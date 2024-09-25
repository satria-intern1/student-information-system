<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Requestletter;
use Illuminate\Http\Request;

class RequestletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($kelasId)
    {
        //
        $user = auth()->user();
        $userData = $user->dosen;

        $className = Kelas::where('id', $kelasId)->value('name');

        $reqLetters = Requestletter::where('kelas_id', $kelasId)->get();

        return view('reqletter.reqList', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
            'className' => $className,
            'reqLetters' => $reqLetters,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = auth()->user();
        $userData = $user->mahasiswa;
        $isMadeReq = ($userData->requestletter)? true : false;
        $isApproved = $userData['edit'];

        return view('reqletter.reqForm', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
            'isMadeReq' => $isMadeReq,
            'isApproved' => $isApproved,
            

        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validatedData = $request->validate([
            'keterangan' => ['required', 'string' , 'max:255'],


            

        ]);        

        Requestletter::Create(
            [
                'kelas_id' => $request['kelas_id'],
                'mahasiswa_id' => $request['mahasiswa_id'],
                'keterangan' => $validatedData['keterangan'],
            ]
        );

 
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Requestletter $requestletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requestletter $requestletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requestletter $requestletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        try {
            $letter = Requestletter::findOrFail($request['reqLetter_id']);
            $letter->delete();

            return back()->with('success', 'request edit deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete request edit. ' . $e->getMessage());
        }

    }

 


}
