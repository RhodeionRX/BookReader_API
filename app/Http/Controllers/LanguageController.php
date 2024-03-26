<?php

namespace App\Http\Controllers;

use App\DTO\Language\AddLanguageDTO;
use App\DTO\Language\DeleteLanguageDTO;
use App\DTO\Language\GetLanguageDTO;
use App\DTO\Language\GetLanguagesDTO;
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

    public function index(Request $request)
    {
        $dto = new GetLanguagesDTO(
            explode(',', $request->input('ids')),
            explode(',', $request->input('codes')),
        );
//        $langs = $this->service->getAllLanguages($dto);
        $idsArray = $request->collect('ids');

        return response()->json($idsArray, Response::HTTP_OK);
    }

    public function show(Request $request)
    {
        $dto = new GetLanguageDTO($request->route('id'));
        $lang = $this->service->getLanguage($dto);

        return response()->json($lang, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $dto = new AddLanguageDTO(...$request->all());
        $lang = $this->service->addLanguage($dto);

        return response()->json([
            'content' => $lang,
            'message' => 'A new language was added successfully'
        ], Response::HTTP_CREATED);
    }

    public function delete(Request $request)
    {
        $dto = new DeleteLanguageDTO(...$request->route('id'));
        $lang = $this->service->removeLanguage($dto);

        return response()->json([
           'content' => $lang,
            'message' => 'The language was deleted from the Data base'
        ], Response::HTTP_OK);
    }

}
