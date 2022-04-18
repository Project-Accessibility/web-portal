@extends('layouts.default')

@section('content')
<header class="bd-header bg-primary p-3 d-flex items-center">
    <div class="container">
        <h1 class="text-white">Stylesheet</h1>
    </div>
</header>
<div class="bg-blue-light">
    <div class="container bg-white p-3">
        <section id="content">
            <h2>Content</h2>
            <div class="row gx-2 mb-5">
                <div class="col-sm-6">
                    <article id="colors">
                        <h3>Kleuren</h3>
                        <div class="w-75">
                            <div class="row mb-3">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <strong class="text-black">Kleurnaam</strong>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <strong class="text-black">Kleur</strong>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <strong class="text-black">Klasse</strong>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Lichtblauw</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-blue-light border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-blue-light</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Blauw</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-blue border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-blue</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Donkerblauw</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-blue-dark border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-blue-dark</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Rood</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-red border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-red</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Oranje</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-orange border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-orange</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Groen</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-green border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-green</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Groenblauw</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-teal border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-teal</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Donkergroenblauw</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-teal-dark border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-teal-dark</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Grijs</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-gray-dark border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-gray</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Zwart</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-black border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-black</span>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Wit</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-white border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-white</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Primary</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-primary border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-primary</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Secondary</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-secondary border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-secondary</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Success</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-success border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-success</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <span class="text-black">Danger</span>
                                </div>

                                <div class="col-sm-3 d-flex">
                                    <div class="stylesheet-color-box bg-danger border border-dark"></div>
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <span class="text-black">.*-danger</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-sm-6 mb-5">
                    <article id="typography">
                        <h3>Typografie</h3>
                        <div class="">
                            <p class="display-1">Display 1</p>
                            <p class="display-2">Display 2</p>
                            <p class="display-3">Display 3</p>
                            <p class="display-4">Display 4</p>
                            <p class="display-5">Display 5</p>
                            <p class="display-6">Display 6</p>

                            <p class="h1">Heading 1</p>
                            <p class="h2">Heading 2</p>
                            <p class="h3">Heading 3</p>
                            <p class="h4">Heading 4</p>
                            <p class="h5">Heading 5</p>
                            <p class="h6">Heading 6</p>

                            <p class="lead">
                                Dit is een hoofdparagraaf. Het onderscheidt zich van gewone alinea's.
                            </p>
                            <div class="row">
                                <div class="col-3">
                                    <code>&lt;mark&gt;</code>
                                </div>
                                <div class="col-9">
                                    <mark>highlight</mark>
                                </div>

                                <div class="col-3">
                                    <code>&lt;del&gt;</code>
                                </div>
                                <div class="col-9">
                                    <del>Deze zin is verwijderd.</del>
                                </div>

                                <div class="col-3">
                                    <code>&lt;s&gt;</code>
                                </div>
                                <div class="col-9">
                                    <s>Deze zin is niet meer accuraat.</s>
                                </div>

                                <div class="col-3">
                                    <code>&lt;ins&gt;</code>
                                </div>
                                <div class="col-9">
                                    <ins>Een toevoeging op een tekst.</ins>
                                </div>

                                <div class="col-3">
                                    <code>&lt;u&gt;</code>
                                </div>
                                <div class="col-9">
                                    <u>Onderstreepte tekst.</u>
                                </div>

                                <div class="col-3">
                                    <code>&lt;small&gt;</code>
                                </div>
                                <div class="col-9">
                                    <small>Deze tekst is kleingedrukt.</small>
                                </div>

                                <div class="col-3">
                                    <code>&lt;strong&gt;</code>
                                </div>
                                <div class="col-9">
                                    <strong>Deze tekst is dikgedrukt.</strong>
                                </div>

                                <div class="col-3">
                                    <code>&lt;em&gt;</code>
                                </div>
                                <div class="col-9">
                                    <em>Schuingedrukte tekst</em>
                                </div>

                                <div class="col-3">
                                    <code>&lt;code&gt;</code>
                                </div>
                                <div class="col-9">
                                    <code>Hierin wordt code gepresenteerd</code>
                                </div>

                            </div>

                            <ul class="list-unstyled">
                                <li>Dit is een lijst.</li>
                                <li>Deze lijst bevat geen styling.</li>
                                <li>Qua formaat is het nog wel een lijst.</li>
                                <li>Er komt alleen styling bij geneste lijsten</li>
                                <li>Geneste lijsten:
                                    <ul>
                                        <li>Deze element heeft wel styling</li>
                                        <li>Daarom staat er een bolletje voor</li>
                                        <li>En heeft een marge links</li>
                                    </ul>
                                </li>
                                <li>Dit kan weleens handig zijn</li>
                            </ul>

                            <ul class="list-inline">
                                <li class="list-inline-item">Dit is een item in een lijst.</li>
                                <li class="list-inline-item">En deze ook.</li>
                                <li class="list-inline-item">Deze lijst is alleen inline</li>
                            </ul>
                        </div>
                    </article>
                </div>
            </div>
            <div class="row gx-2 mb-5">
                <article class="col-sm-6" id="images">
                    <h2>Plaatjes</h2>
                    <div class="d-flex gap-2">
                        <div class="bd-example w-100">
                            <svg class="bd-placeholder-img bd-placeholder-img-lg img-fluid" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Responsive image" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Responsive plaatje</text></svg>
                        </div>

                        <div class="bd-example">
                            <figure class="figure">
                                <svg class="bd-placeholder-img figure-img img-fluid rounded" width="400" height="300" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 400x300" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">400x300</text></svg>

                                <figcaption class="figure-caption">Een onderschrift</figcaption>
                            </figure>
                        </div>
                    </div>
                </article>
                <article class="col-sm-6" id="tables">
                    <h2>Tabellen</h2>
                    <div class="w-100">
                        @php
                            $headers = ['id','naam','leeftijd'];

                            $item_one = [
                                'id' => 1,
                                'name' => 'test',
                                'age' => 28,
                            ];
                            $item_two = [
                                'id' => 2,
                                'name' => 'test twee',
                                'age' => 33,
                            ];
                            $items = [$item_one, $item_two];

                            $keys = ['id','name','age'];

                            $tableLinks = collect([
                                new \App\Utils\TableLink('inputs'),
                                new \App\Utils\TableLink('stylesheet')
                            ]);

                            $rowLink = new \App\Utils\TableLink('inputs');
                        @endphp

                        <x-table :headers="$headers" :items="$items" :keys="$keys" :rowLink="$rowLink" :tableLinks="$tableLinks"/>

                    </div>
                </article>
            </div>
        </section>

        <section id="forms" class="mb-5">
            <h2>Formulieren</h2>
            <div class="row gx-2 mb-3">
                <div class="col-sm-6">
                    <article id="overview">
                        <h3>Algemeen</h3>
                        <div>
                            <div class="bd-example">
                                <form>
                                        <x-input label="test" type="text" name="Normaal invoerveld" placeholder="input"></x-input>
                                        @php
                                            $extraData = [
                                                'multiple' => false,
                                                'options' => [
                                                    ['option_1', 'value_1'],
                                                    ['option_2', 'value_2'],
                                                ],
                                            ];
                                        @endphp
                                        <x-input label="test" type="select" name="Selectie" :extraData="$extraData" value="value_2"></x-input>
                                        <x-input label="test" type="date" name="Datum" value="2021-03-21"></x-input> <x-input label="test" type="datetime" name="Datum & tijd" value="2021-03-21T08:00"></x-input>
                                        <label class="form-label" for="customFile">Upload</label>
                                        <input type="file" class="form-control" id="customFile">
                                        <x-input label="test" type="switch" name="Switch" :value="true"></x-input>
                                        @php
                                            $extraData= [
                                                'min' => 0,
                                                'max' => 5,
                                                'step' => 0.5
                                            ];
                                        @endphp
                                        <x-input label="test" type="range" name="slider" :extraData="$extraData" :value="1.5"></x-input>
                                    <x-button type="primary">Submit</x-button>
                                </form>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-sm-6">
                    <article id="disabled-forms">
                        <h3>Uitgeschakeld</h3>
                        <div>
                            <div class="bd-example">
                                <form>
                                    <fieldset disabled aria-label="Disabled fieldset example">
                                        <x-input label="test" type="text" name="Normaal invoerveld" placeholder="input"></x-input>
                                        @php
                                            $extraData = [
                                                'multiple' => false,
                                                'options' => [
                                                    ['option_1', 'value_1'],
                                                    ['option_2', 'value_2'],
                                                ],
                                            ];
                                        @endphp
                                        <x-input label="test" type="select" name="Selectie" :extraData="$extraData" value="value_2"></x-input>
                                        <x-input label="test" type="date" name="Datum" value="2021-03-21"></x-input> <x-input label="test" type="datetime" name="Datum & tijd" value="2021-03-21T08:00"></x-input>
                                        <label class="form-label" for="customFile">Upload</label>
                                        <input type="file" class="form-control" id="customFile">
                                        <x-input label="test" type="switch" name="Switch" :value="true"></x-input>
                                        @php
                                            $extraData= [
                                                'min' => 0,
                                                'max' => 5,
                                                'step' => 0.5
                                            ];
                                        @endphp
                                        <x-input label="test" type="range" name="slider" :extraData="$extraData" :value="1.5"></x-input>
                                        <x-button type="primary">Submit</x-button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <article class="my-3" id="input-group">
                <div>
                    <div class="bd-example">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Gebruikersnaam" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Jouw naam" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">@accessibility.nl</span>
                        </div>
                    </div>
                </div>
            </article>
            <article class="my-3" id="validation">
                <div>
                    <div class="bd-example">
                        <form class="row g-3">
                            <div class="col-md-4">
                                <label for="validationServer01" class="form-label">Voornaam</label>
                                <input type="text" class="form-control is-valid" id="validationServer01" value="Mark" required>
                                <div class="valid-feedback">
                                    Goed!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer02" class="form-label">Achternaam</label>
                                <input type="text" class="form-control is-invalid" id="validationServer02" value="Otto" required>
                                <div class="invalid-feedback">
                                    Fout!
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </article>
        </section>

        <section id="components">
            <h2>Componenten</h2>
            <div class="row gx-2 mb-3">
                <div class="col-sm">
                    <article id="accordion">
                        <h3>Accordion</h3>
                        <div>
                            <div class="bd-example">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h4 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Accordion Item #1
                                            </button>
                                        </h4>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <strong>Dit is de inhoud van accordion.</strong> Hierin kan veel data komen te staan welke je weer kan inklappen of uitklappen.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Accordion Item #2
                                            </button>
                                        </h4>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <strong>Dit is de inhoud van accordion.</strong> Hierin kan veel data komen te staan welke je weer kan inklappen of uitklappen.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Accordion Item #3
                                            </button>
                                        </h4>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <strong>Dit is de inhoud van accordion.</strong> Hierin kan veel data komen te staan welke je weer kan inklappen of uitklappen.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-sm">
                    <article id="alerts">
                        <h3>Alerts</h3>
                        <div>
                            <div class="bd-example">

                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    Een primary alert.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                    Een secondary alert.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Een success alert.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Een danger alert.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    Een donkere alert.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="row gx-2 mb-3">
                <div class="col-sm">
                    <article id="badge">
                        <h3>Badges</h3>
                        <div>
                            <span class="badge rounded-pill bg-secondary">Secondary</span>
                            <span class="badge rounded-pill bg-success">Success</span>
                            <span class="badge rounded-pill bg-danger">Danger</span>
                            <span class="badge rounded-pill bg-dark">Dark</span>
                        </div>
                    </article>
                </div>
                <div class="col-sm">
                    <article id="breadcrumb">
                        <h3>Breadcrumb</h3>
                        <div>
                            <div class="bd-example">
                                <x-breadcrumb />
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="row gx-2 mb-3">
                <div class="col-sm-6">
                    <article id="buttons">
                        <h3>Buttons</h3>
                        <div>
                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                <x-button type="primary">Primary</x-button>
                                <x-button type="secondary">Secondary</x-button>
                                <x-button type="remove">Verwijderen</x-button>

                                <x-button type="" link="./">Link</x-button>

                                <div class="btn-group w-100 align-items-center justify-content-between flex-wrap">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Dropdown knop
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><h6 class="dropdown-header">Dropdown header</h6></li>
                                            <li><a class="dropdown-item" href="#">Actie</a></li>
                                            <li><a class="dropdown-item" href="#">Nog een actie</a></li>
                                            <li><a class="dropdown-item" href="#">En nog meer hier</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#">Een gescheiden link van de rest</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-sm-6">
                    <article id="modal">
                        <h3>Modals</h3>
                        <div>
                            <div class="bd-example">
                                <div class="d-flex flex-wrap gap-2">
                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalDefault">
                                            Open demo modal
                                        </button>
                                    </div>

                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropLive">
                                            Open statische achtergrond modal
                                        </button>
                                    </div>

                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollable">
                                            Open gecentreerde scrollbare modal
                                        </button>
                                    </div>

                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen">
                                            Volledig scherm
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="row gx-2 mb-3">
                <div class="col-sm-6">
                    <article class="my-3" id="navs">
                        <h3>Navigatie</h3>
                        <div>
                            <div class="bd-example">
                                <nav>
                                    <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profiel</button>
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <p>Deze tekst er staan.</p>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <p>Deze tekst er staan.</p>
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <p>Deze tekst er staan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-sm-6">
                    <article class="my-3" id="pagination">
                        <h3>Paginering</h3>
                        <div>
                            <div class="bd-example">
                                <nav aria-label="Standard pagination example">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="row gx-2 mb-3">
                <div class="col-sm-6">
                    <article class="my-3" id="progress">
                        <h3>Progressie</h3>
                        <div>
                            <div class="bd-example">
                                <div class="progress mb-3">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-success w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-info w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-warning w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-sm-6">
                    <article class="mt-3 mb-5 pb-5" id="tooltips">
                        <h3>Tooltips</h3>
                        <div>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">Tooltip boven</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Tooltip on end">Tooltip rechts</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom">Tooltip beneden</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Tooltip on start">Tooltip links</button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <article class="my-3" id="toasts">
                <div>
                    <div class="bd-example bg-primary p-3 align-items-center">
                        <div class="mb-3 d-grid gap-2">
                            <h3 class="text-white">Donkere achtergrond</h3>
                            <hr class="bg-light border-2 border-top border-light">
                            <div class="alert alert-light alert-dismissible fade show" role="alert">
                                Alert!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <div>
                                <span class="badge rounded-pill bg-light text-black">Wit</span>
                            </div>
                            <div>
                                <button type="button" class="btn btn-light">Wit</button>
                            </div>
                        </div>
                        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#007aff"/></svg>

                                <strong class="me-auto">Bootstrap</strong>
                                <small class="text-muted">11 min geleden</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body text-black">
                                Dit is een berichtje in een 'toast'.
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
    </div>

    <div class="modal fade" id="exampleModalDefault" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdropLive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLiveLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>I will not close if you click outside me. Don't even try to press escape key.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>This is some placeholder content to show the scrolling behavior for modals. We use repeated line breaks to demonstrate how content can exceed minimum inner height, thereby showing inner scrolling. When content becomes longer than the prefedined max-height of modal, content will be cropped and scrollable within the modal.</p>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <p>This content should appear at the bottom after you scroll.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalFullscreenLabel">Full screen modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
