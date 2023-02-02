<?php

namespace App\Services;

use App\Http\Requests\UpdateOrganizationRequest;
use App\Http\Requests\UserRequest;
use App\Models\Organizations;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

class FileService
{
    public function parseXml($request)
    {
        foreach ($request as $org0) {
            $org = [
                'name' => (string)$org0->attributes()['displayName'],
                'ogrn' => (string)$org0->attributes()['ogrn'],
                'oktmo' => (string)$org0->attributes()['oktmo']
            ];

            try {
                $rules = new UpdateOrganizationRequest();
                $organization = Organizations::updateOrCreate(['ogrn' => $org['ogrn']], validator($org, $rules->rules())->validated());
            } catch (\Exception $exception){
                DB::rollBack();
                return back()->with('error', $exception->getMessage());
            }

            foreach ($org0 as $user0) {
                $currentUser = [
                    'surname' => (string)$user0->attributes()['lastname'],
                    'name' => (string)$user0->attributes()['firstname'],
                    'patronymic' => (string)$user0->attributes()['middlename'],
                    'birthdate' => (string)$user0->attributes()['birthday'] ?: null,
                    'inn' => (string)$user0->attributes()['inn'],
                    'snils' => (string)$user0->attributes()['snils']
                ];

                try {
                    $rules = new UserRequest();
                    $validatedUser = validator($currentUser, $rules->rules())->validated();
                    if ($validatedUser) {
                        DB::transaction(function () use ($validatedUser, $organization) {
                            // $user = Users::updateOrCreate(['inn' => $validatedUser['inn']], $validatedUser);
                            $user = new Users($validatedUser);
                            $user->save();
                            $user->organizations()->attach($organization->id);
                        });
                    }
                } catch (\Exception $exception) {
                    DB::rollBack();
                    return back()->with('error', $exception->getMessage());
                }
            }
        }
        return back()->with('success', 'Файл был импортирован');
    }
}
