<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResearchRequest;
use App\Models\Research;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Symfony\Component\Console\Input\Input;

class ResearchController extends Controller
{

    public function overview(): View
    {
        $researches = Research::all()->toArray();
        return view('admin.research.overview', [
            "researches" => $researches
        ]);
    }

    public function create(): View
    {
        return view('admin.research.create');
    }

    public function store(StoreResearchRequest $request): Application|RedirectResponse|Redirector
    {
        $request->validated();
        Research::create($request->all());
        return redirect(route('researches'))->with('success', "Het onderzoek is aangemaakt!");
    }

    public function edit($id): View
    {
        $research = Research::whereId($id)->first();
        if ($research === null) {
            abort(404, 'Research with that ID does not exist');
        }
        return view('admin.research.edit', [
            "research" => $research
        ]);
    }

    public function update(StoreResearchRequest $request, $id): Application|RedirectResponse|Redirector
    {
        $request->validated();
        $research = Research::whereId($id)->first();
        if ($research === null) {
            abort(404, 'Research with that ID does not exist');
        }
        $research->update($request->all());
        return redirect(route('researches.details', [
            "id" => $research->id,
            "tab" => "Details"
        ]))->with('success', "Het onderzoek is aangepast!");
    }

    public function details(Request $request, $id): View|Factory|Redirector|RedirectResponse|Application
    {
        if(!$request->has('tab')){
            return redirect(route('researches.details', [
                "id" => $id,
                "tab" => "Details"
            ]));
        }
        $research = Research::whereId($id)->first();
        if ($research === null) {
            abort(404, 'Research with that ID does not exist');
        }
        return view('admin.research.details', [
            "research" => $research
        ]);
    }

    public function remove($id): Application|RedirectResponse|Redirector
    {
        $research = Research::whereId($id)->first();
        if ($research === null) {
            abort(404, 'Research with that ID does not exist');
        }
        $research->delete();
        return redirect(route('researches'))->with('success', "Het onderzoek is verwijderd!");
    }

    public function archive($id)
    {
    }

    public function archives()
    {
    }

    public function restore($id)
    {
    }

    public function deletes()
    {
    }
}
