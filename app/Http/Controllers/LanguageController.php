<?php

namespace App\Http\Controllers;

use App\DTO\Language\AddLanguageDTO;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LanguageController extends Controller
{
    protected $service;
    public function __construct(LanguageService $languageService)
    {
        $this->service = $languageService;
    }

    public function get()
    {

    }

    public function addLanguage(Request $request)
    {
        $addLanguageDTO = new AddLanguageDTO(...$request->all());
        $lang = $this->service->addLanguage($addLanguageDTO);// Response::HTTP_CREATED
        return response()->json([
            'language' => $lang,
            'message' => 'Language was added successfully'
        ], Response::HTTP_CREATED);
    }
}
