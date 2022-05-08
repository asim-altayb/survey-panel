<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use MattDaneshvar\Survey\Models\Survey;

class SurveyController extends Controller
{
    public function index()
    {
        return Inertia::render('Surveys/Index', [
            'filters' => Request::all('search', 'trashed'),
            'surveys' => Survey::orderBy('name')
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($survey) => [
                    'id' => $survey->id,
                    'name' => $survey->name,
                    'deleted_at' => null,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Surveys/Create');
    }

    public function store()
    {
        Auth::user()->account->surveys()->create(
            Request::validate([
                'name' => ['required', 'max:100'],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
            ])
        );

        return Redirect::route('surveys')->with('success', 'Survey created.');
    }

    public function edit(Survey $survey)
    {
        return Inertia::render('Surveys/Edit', [
            'survey' => [
                'id' => $survey->id,
                'name' => $survey->name,
                'email' => $survey->email,
                'phone' => $survey->phone,
                'address' => $survey->address,
                'city' => $survey->city,
                'region' => $survey->region,
                'country' => $survey->country,
                'postal_code' => $survey->postal_code,
                'deleted_at' => $survey->deleted_at,
                'contacts' => $survey->contacts()->orderByName()->get()->map->only('id', 'name', 'city', 'phone'),
            ],
        ]);
    }

    public function update(Survey $survey)
    {
        $survey->update(
            Request::validate([
                'name' => ['required', 'max:100'],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
            ])
        );

        return Redirect::back()->with('success', 'Survey updated.');
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();

        return Redirect::back()->with('success', 'Survey deleted.');
    }

    public function restore(Survey $survey)
    {
        $survey->restore();

        return Redirect::back()->with('success', 'Survey restored.');
    }
}
