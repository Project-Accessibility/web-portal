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
            'researches' => $researches,
        ]);
    }

    public function create(): View
    {
        return view('admin.research.create');
    }

    public function store(
        StoreResearchRequest $request,
    ): Application|RedirectResponse|Redirector {
        $request->validated();
        Research::create($request->all());

        return redirect(route('researches'))->with(
            'success',
            'Het onderzoek is aangemaakt!',
        );
    }

    public function edit(Research $research): View
    {
        return view('admin.research.edit', [
            'research' => $research,
        ]);
    }

    public function update(
        StoreResearchRequest $request,
        Research $research,
    ): RedirectResponse {
        $request->validated();
        $research->update($request->all());

        return redirect(
            route('researches.details', [
                'research' => $research,
                'tab' => 'Details',
            ]),
        )->with('success', 'Het onderzoek is aangepast!');
    }

    public function details(Request $request, Research $research): View
    {
        return view('admin.research.details', [
            'research' => $research,
        ]);
    }

    public function remove(
        Research $research,
    ): Application|RedirectResponse|Redirector {
        $research->delete();

        return redirect(route('researches'))->with(
            'success',
            'Het onderzoek is verwijderd!',
        );
    }

    public function archive(Research $research)
    {
    }

    public function archives()
    {
    }

    public function restore(Research $research)
    {
    }

    public function deletes()
    {
    }
}
