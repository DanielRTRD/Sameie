<?php

namespace Sameie\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sameie\Condo;

class CondoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $condos = Auth::user()->managing;
        // Check if user has relation
        if ($condos->isEmpty()) {
            abort(403, $message = 'Du har ikke tilgang.');
        }
        return view('condo.index')->with('condos', $condos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $condo = Condo::where('orgnr', $id)->firstOrFail();
        // Check if user has relation
        if (!Auth::user()->condos->contains($condo->id)) {
            abort(403, $message = 'Du har ikke tilgang.');
        }
        abort_unless($condo, 404);

        // Hent ut data fra BRREG APIet
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://data.brreg.no/enhetsregisteret/api/enheter/".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $brreg = null;
        } else {
            $brreg = json_decode($response, true);
        }
        if (!$brreg) {
            $brreg = [];
        }
        
        // Vis view når alt er klart
        return view('condo.show')->withCondo($condo)->withBrreg($brreg);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $condo = Condo::where('orgnr', $id)->firstOrFail();
        // Check if user has relation
        if (!$condo->managers->contains(Auth::user()->id)) {
            abort(403, $message = 'Du har ikke tilgang.');
        }
        return view('condo.edit', $condo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
