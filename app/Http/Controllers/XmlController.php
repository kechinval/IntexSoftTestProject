<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FileService;

class XmlController extends Controller
{

    public function index()
    {
        return view('xml.index');
    }

    public function store(Request $request)
    {
        if (! $request->hasFile('file')) {
            return back()->with('error', 'Error mf');
        }
        $xmlDataString = file_get_contents($request->file('file'));
        $xmlObject = simplexml_load_string($xmlDataString);

        $service = new FileService();
        $service->parseXml($xmlObject);

        return redirect()->back();
    }
}
