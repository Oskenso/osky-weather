<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // TODO: Find/Create laravel Dark Sky Service

        $lat = (float) $request->query('la');
        $long = (float) $request->query('lo');
        $dsSecret = env('DARKSKY_SECRET', NULL);

        if ($dsSecret == NULL) {
            return FALSE; // TODO: Handle erros
        }

        $darkSkyUrl = "https://api.darksky.net/forecast/";
        $darkSkyUrl .= $dsSecret;
        $darkSkyUrl .= '/' . $lat . ',' . $long;


        $client = new \GuzzleHttp\Client();

        return response()->json(
            json_decode($client->get($darkSkyUrl, [
                'query' => [
                ],
            ])->getBody())
        );
    }

    private function geoLookup($query) {

        $inputZipCode = (int) $query;
        //echo getcwd() . "\n";
        $zipMap = file_get_contents('./us-zip-code-latitude-and-longitude.json');
        
        $zipMap = json_decode($zipMap);

        $matchFound = FALSE;
        $match = null;

        //echo sprintf("", $inputZipCode);
        foreach ($zipMap as $l) {
            //print_r($l->fields);
            if ($inputZipCode == $l->fields->zip)
            {
                $matchFound = TRUE;
                $match = $l->fields;
                break;

            }

        }

        print_r($match);
        die();
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
    public function show($query)
    {
        $location = app()->make('GeoHelper')->findZip($query);
        return response()->json($location);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
