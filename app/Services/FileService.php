<?php

namespace App\Services;

use App\Http\Requests\CreateOrUpdateOrganizationRequest;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UserRequest;
use App\Models\Organizations;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

class FileService
{
    public function parseXml($file)
    {
        $xml = new \XMLReader();
        $xml->open($file);

        while ($xml->read()) {

            if ($xml->nodeType == \XMLReader::ELEMENT && $xml->name == 'org') {

                $org = [
                    'name' => $xml->getAttribute('displayName'),
                    'ogrn' => $xml->getAttribute('ogrn'),
                    'oktmo' => $xml->getAttribute('oktmo')
                ];

                try {
                    $rules = new CreateOrUpdateOrganizationRequest();
                    $organization = Organizations::updateOrCreate(['ogrn' => $org['ogrn']], validator($org, $rules->rules($org))->validated());
                } catch (\Exception $exception) {
                    DB::rollBack();
                    return back()->with('error', $exception->getMessage());
                }

                if ($xml->readInnerXml()) {
                    $users = simplexml_load_string($xml->readOuterXML());
                    foreach ($users as $user) {
                        $currentUser = [
                            'surname' => (string)$user->attributes()['lastname'],
                            'name' => (string)$user->attributes()['firstname'],
                            'patronymic' => (string)$user->attributes()['middlename'],
                            'birthdate' => (string)$user->attributes()['birthday'] ?: null,
                            'inn' => (string)$user->attributes()['inn'],
                            'snils' => (string)$user->attributes()['snils']
                        ];

                        try {
                            $rules = new UserRequest();
                            $validatedUser = validator($currentUser, $rules->rules())->validated();
                            DB::transaction(function () use ($validatedUser, $organization, $rules) {
                                $user = new Users($validatedUser);
                                $user->save();
                                $user->organizations()->sync($organization->id);
                            });
                        } catch (\Exception $exception) {
                            DB::rollBack();
                        }
                    }
                }
            }
        }
        $xml->close();

        return back()->with('success', 'Файл был импортирован');
    }
}
