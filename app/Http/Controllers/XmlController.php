<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Users;
use App\Models\Organizations;
use App\helpers;

class XmlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('xml.index');
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
        $xmlDataString = file_get_contents($request->file('file'));
        $xmlObject = simplexml_load_string($xmlDataString);

        foreach ($xmlObject as $organization) {

            $org = [
                'name' => (string)$organization->attributes()['displayName'],
                'ogrn' => (string)$organization->attributes()['ogrn'],
                'oktmo' => (string)$organization->attributes()['oktmo']
            ];

            $validatedOrg = validate_organization($org);

            foreach ($organization as $user) {

                $currentUser = [
                    'surname' => (string)$user->attributes()['lastname'],
                    'name' => (string)$user->attributes()['firstname'],
                    'patronymic' => (string)$user->attributes()['middlename'],
                    'birthdate' => (string)$user->attributes()['birthday'],
                    'inn' => (string)$user->attributes()['inn'],
                    'snils' => (string)$user->attributes()['snils']
                ];

                $validatedUser = validate_user($currentUser);

            }
        }

        foreach ($xmlObject as $org){
            $organization = new Organizations();
            $organization->name = $org->attributes()['displayName'];
            $organization->ogrn = $org->attributes()['ogrn'];
            $organization->oktmo = $org->attributes()['oktmo'];
            $organization->save();

            foreach ($org as $user0) {
                $user = new Users();
                $user->surname = $user0->attributes()['lastname'];
                $user->name = $user0->attributes()['firstname'];
                $user->patronymic = $user0->attributes()['middlename'];
                $user->birthdate = $user0->attributes()['birthday'];
                $user->inn = $user0->attributes()['inn'];
                $user->snils = $user0->attributes()['snils'];
                $user->organizations_id = $organization->id;
                $user->save();
                }
        }

        return view('xml.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
