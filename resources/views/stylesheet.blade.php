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
                @php
                    $item_one = [
                        'id' => 1,
                        'name' => 'test',
                        'age' => 28,
                    ];

                    $item_two = [
                        'id' => 2,
                        'name' => 'test_two',
                        'age' => 33,
                    ];
                    $items = [$item_one, $item_two];

                    $tableLinks = collect([
                        new \App\Utils\TableLink('Welcome', 'welcome'),
                        new \App\Utils\TableLink('Stylesheet', 'stylesheet')
                    ]);
                @endphp

            <x-table :headers="['id','naam','leeftijd']" :items="$items" :keys="['id','name','age']" :tableLinks="$tableLinks"/>

            <div class="row gx-2 mb-5">
                <div class="col-sm-6">
                    <article id="colors">
                        <h3>Kleuren</h3>
                        <div class="w-75">
                            <div class="row mb-3">
                                <div class="col-sm-5 d-flex align-items-center">
                                    <strong class="text-black">kleurnaam</strong>
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
                                This is a lead paragraph. It stands out from regular paragraphs.
                            </p>
                            <p>You can use the mark tag to <mark>highlight</mark> text.</p>
                            <p><del>This line of text is meant to be treated as deleted text.</del></p>
                            <p><s>This line of text is meant to be treated as no longer accurate.</s></p>
                            <p><ins>This line of text is meant to be treated as an addition to the document.</ins></p>
                            <p><u>This line of text will render as underlined.</u></p>
                            <p><small>This line of text is meant to be treated as fine print.</small></p>
                            <p><strong>This line rendered as bold text.</strong></p>
                            <p><em>This line rendered as italicized text.</em></p>

                            <ul class="list-unstyled">
                                <li>This is a list.</li>
                                <li>It appears completely unstyled.</li>
                                <li>Structurally, it's still a list.</li>
                                <li>However, this style only applies to immediate child elements.</li>
                                <li>Nested lists:
                                    <ul>
                                        <li>are unaffected by this style</li>
                                        <li>will still show a bullet</li>
                                        <li>and have appropriate left margin</li>
                                    </ul>
                                </li>
                                <li>This may still come in handy in some situations.</li>
                            </ul>

                            <ul class="list-inline">
                                <li class="list-inline-item">This is a list item.</li>
                                <li class="list-inline-item">And another one.</li>
                                <li class="list-inline-item">But they're displayed inline.</li>
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
                            <svg class="bd-placeholder-img bd-placeholder-img-lg img-fluid" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Responsive image" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Responsive image</text></svg>
                        </div>

                        <div class="bd-example">
                            <figure class="figure">
                                <svg class="bd-placeholder-img figure-img img-fluid rounded" width="400" height="300" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 400x300" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"/><text x="50%" y="50%" fill="#dee2e6" dy=".3em">400x300</text></svg>

                                <figcaption class="figure-caption">A caption for under the image.</figcaption>
                            </figure>
                        </div>
                    </div>
                </article>
                <article class="col-sm-6" id="tables">
                    <h2>Tabellen</h2>
                    <div class="w-100">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
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
                                    <div class="mb-3">
                                        <x-input type="text" name="Normaal invoerveld" placeholder="input"></x-input>
                                    </div>
                                    <div class="mb-3">
                                        @php
                                        $extraData = [
                                            'multiple' => false,
                                            'options' => [
                                                ['option_1', 'value_1'],
                                                ['option_2', 'value_2'],
                                            ],
                                        ];
                                        @endphp
                                        <x-input type="select" name="Selectie" :extraData="$extraData" value="value_2"></x-input>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                    <div class="mb-3">
                                        <x-input type="date" name="Datum" value="2021-03-21"></x-input> <x-input type="datetime" name="Datum & tijd" value="2021-03-21T08:00"></x-input>
                                    </div>
                                    <fieldset class="mb-3">
                                        <legend>Radios buttons</legend>
                                        <div class="form-check">
                                            <input type="radio" name="radios" class="form-check-input" id="exampleRadio1">
                                            <label class="form-check-label" for="exampleRadio1">Default radio</label>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="radio" name="radios" class="form-check-input" id="exampleRadio2">
                                            <label class="form-check-label" for="exampleRadio2">Another radio</label>
                                        </div>
                                    </fieldset>
                                    <div class="mb-3">
                                        <label class="form-label" for="customFile">Upload</label>
                                        <input type="file" class="form-control" id="customFile">
                                    </div>
                                    <div class="mb-3">
                                        <x-input type="switch" name="Switch" :value="true"></x-input>
                                    </div>
                                    <div class="mb-3">
                                        @php
                                        $extraData= [
                                            'min' => 0,
                                            'max' => 5,
                                            'step' => 0.5
                                        ];
                                        @endphp
                                        <x-input type="range" name="input" :extraData="$extraData" :value="1.5"></x-input>
                                    </div>
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
                                        <div class="mb-3">
                                            <x-input type="text" name="Normaal invoerveld" placeholder="input"></x-input>
                                        </div>
                                        <div class="mb-3">
                                            @php
                                                $extraData = [
                                                    'multiple' => false,
                                                    'options' => [
                                                        ['option_1', 'value_1'],
                                                        ['option_2', 'value_2'],
                                                    ],
                                                ];
                                            @endphp
                                            <x-input type="select" name="Selectie" :extraData="$extraData" value="value_2"></x-input>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                        </div>
                                        <div class="mb-3">
                                            <x-input type="date" name="Datum" value="2021-03-21"></x-input> <x-input type="datetime" name="Datum & tijd" value="2021-03-21T08:00"></x-input>
                                        </div>
                                        <fieldset class="mb-3">
                                            <legend>Radios buttons</legend>
                                            <div class="form-check">
                                                <input type="radio" name="radios" class="form-check-input" id="exampleRadio1">
                                                <label class="form-check-label" for="exampleRadio1">Default radio</label>
                                            </div>
                                            <div class="mb-3 form-check">
                                                <input type="radio" name="radios" class="form-check-input" id="exampleRadio2">
                                                <label class="form-check-label" for="exampleRadio2">Another radio</label>
                                            </div>
                                        </fieldset>
                                        <div class="mb-3">
                                            <label class="form-label" for="customFile">Upload</label>
                                            <input type="file" class="form-control" id="customFile">
                                        </div>
                                        <div class="mb-3">
                                            <x-input type="switch" name="Switch" :value="true"></x-input>
                                        </div>
                                        <div class="mb-3">
                                            @php
                                                $extraData= [
                                                    'min' => 0,
                                                    'max' => 5,
                                                    'step' => 0.5
                                                ];
                                            @endphp
                                            <x-input type="range" name="input" :extraData="$extraData" :value="1.5"></x-input>
                                        </div>
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
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">@example.com</span>
                        </div>
                    </div>
                </div>
            </article>
            <article class="my-3" id="validation">
                <div>
                    <div class="bd-example">
                        <form class="row g-3">
                            <div class="col-md-4">
                                <label for="validationServer01" class="form-label">First name</label>
                                <input type="text" class="form-control is-valid" id="validationServer01" value="Mark" required>
                                <div class="valid-feedback">
                                    Goed!
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationServer02" class="form-label">Last name</label>
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
                                                <strong>This is the first item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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
                                                <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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
                                                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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
                                    A simple primary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                    A simple secondary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    A simple success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    A simple danger alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    A simple dark alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>

                            <div class="bd-example">
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Well done!</h4>
                                    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                                    <hr>
                                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
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
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                                    </ol>
                                </nav>
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

                                <x-button type="" link="test.com">Link</x-button>

                                <div class="btn-group w-100 align-items-center justify-content-between flex-wrap">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Dropdown button
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><h6 class="dropdown-header">Dropdown header</h6></li>
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#">Separated link</a></li>
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
                                            Launch demo modal
                                        </button>
                                    </div>

                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropLive">
                                            Launch static backdrop modal
                                        </button>
                                    </div>

                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollable">
                                            Vertically centered scrollable modal
                                        </button>
                                    </div>

                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen">
                                            Full screen
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
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <p><strong>This is some placeholder content the Home tab's associated content.</strong> Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <p><strong>This is some placeholder content the Profile tab's associated content.</strong> Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <p><strong>This is some placeholder content the Contact tab's associated content.</strong> Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
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
                                <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">Tooltip on top</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Tooltip on end">Tooltip on end</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom">Tooltip on bottom</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Tooltip on start">Tooltip on start</button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <article class="my-3" id="toasts">
                <div>
                    <div class="bd-example bg-primary p-3 align-items-center">
                        <div class="mb-3 d-grid gap-2">
                            <h3 class="text-white">Examples with dark background</h3>
                            <hr class="bg-light border-2 border-top border-light">
                            <div class="alert alert-light alert-dismissible fade show" role="alert">
                                A simple light alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <p class="h6 text-white">Example heading <span class="badge bg-light text-black">New</span></p>
                            <div>
                                <span class="badge rounded-pill bg-light text-black">Light</span>
                            </div>
                            <div>
                                <button type="button" class="btn btn-light">Light</button>
                            </div>
                        </div>
                        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#007aff"/></svg>

                                <strong class="me-auto">Bootstrap</strong>
                                <small class="text-muted">11 mins ago</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body text-black">
                                Hello, world! This is a toast message.
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
