<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MattDaneshvar\Survey\Models\Entry;
use MattDaneshvar\Survey\Models\Survey;

class AnswersController extends Controller
{
    public function index(Survey $survey)
    {
        return view('survey',['survey'=>$survey]);
    }

    public function store(Survey $survey, Request $request)
    {
        $answers = $this->validate($request, $survey->rules);

        (new Entry())->for($survey)->fromArray($answers)->push();
    }
}
