<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FileService;
use SbWereWolf\XmlNavigator\Convertation\FastXmlToArray;

class XmlController extends Controller
{

    public function index()
    {
        return view('xml.index');
    }

    public function store(Request $request)
    {
        if (!$request->hasFile('file')) {
            return back()->with('error', 'Error: no file given');
        }

        $service = new FileService();
        $service->parseXml($request->file('file'));

        return redirect()->back();
    }
}
