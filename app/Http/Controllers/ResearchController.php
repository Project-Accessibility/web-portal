<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResearchRequest;
use App\Models\Research;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ResearchController extends Controller
{

    public function overview(): View
    {
        $researches = Research::all();
        return view('research.overview', [
            "researches" => $researches
        ]);
    }

    public function create(): View
    {
        return view('research.create');
    }

    public function store(StoreResearchRequest $request): View
    {
        $data = $request->validated();
        Research::create([
            $data
        ]);
        return view('research.overview')->with('success', "Het onderzoek is aangemaakt!");
    }

    public function edit($id): View
    {
        $research = Research::whereId($id);
        if ($research === null) {
            abort(404, 'Research with that ID does not exist');
        }
        return view('research.edit', [
            "research" => $research
        ]);
    }

    public function update(StoreResearchRequest $request, $id): View
    {
        $data = $request->validated();
        $research = Research::whereId($id);
        if ($research === null) {
            abort(404, 'Research with that ID does not exist');
        }
        $research->update($data);
        return view('research.details', [
            "research" => $research,
            "tab" => "details"
        ]);
    }

    public function details(Request $request, $id): View
    {
        $research = Research::whereId($id);
        if ($research === null) {
            abort(404, 'Research with that ID does not exist');
        }
        $tab = $request->query("tab");
        return view('research.details', [
            "research" => $research,
            "tab" => $tab
        ]);
    }

    public function remove($id): View
    {
        $research = Research::whereId($id);
        if ($research === null) {
            abort(404, 'Research with that ID does not exist');
        }
        $research->delete();
        $researches = Research::all();
        return view('admin.research.overview', [
            "researches" => $researches
        ])->with('success', "Het onderzoek is verwijderd!");
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
