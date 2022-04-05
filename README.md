# Project Accessibility Web Portal

[![DeepScan grade](https://deepscan.io/api/teams/17161/projects/20524/branches/562465/badge/grade.svg)](https://deepscan.io/dashboard#view=project&tid=17161&pid=20524&bid=562465)

[![Laravel Tests](https://github.com/Project-Accessibility/web-portal/workflows/Laravel/badge.svg)](https://github.com/Project-Accessibility/web-portal/actions/)
[![Prettier](https://github.com/Project-Accessibility/web-portal/workflows/Prettier/badge.svg)](https://github.com/Project-Accessibility/web-portal/actions/)

[![Okteto Dev](https://github.com/Project-Accessibility/web-portal/workflows/Okteto%20Dev%20Deployment/badge.svg)](https://github.com/Project-Accessibility/web-portal/actions/)
[![Okteto Acc](https://github.com/Project-Accessibility/web-portal/workflows/Okteto%20Acc%20Deployment/badge.svg)](https://github.com/Project-Accessibility/web-portal/actions/)

-   [Project Accessibility Web Portal](#project-accessibility-web-portal)
    -   [Requirements](#requirements)
    -   [Development](#development)

## Requirements

-   Node v16.13.0 or later
-   NPM v8.5.4 or later
-   Yarn v1.22.17 or later
-   PHP 8.1 or later
-   MySQL 8.0 or later
-   Composer 2.2.7 or later

## Development

-   Run `npm i -g yarn` to install yarn.
-   Run `yarn prepare` to install GitHooks.
-   Run `yarn watch` real-time compiling of CSS/JS files.
-   Run `php artisan serve` to run the application.
-   Run `./vendor/bin/sail up` to run the application in Docker.
-   Run `php artisan migrate` to run the database migrations.
-   Run `php artisan db:seed` to run the database seeders.
-   Run `php artisan key:generate` to generate the application key.

## Api

### Routes

De api's zijn te bereiken via `/api`.<br>
De API bestaat uit de volgende routes.

<details>
    <summary>Alle API routes</summary>

    | Route                           | Methode | Query                                 | Response                                                                                 |
    |---------------------------------|---------|---------------------------------------|------------------------------------------------------------------------------------------|
    | /ping                           | GET     |                                       | Pong                                                                                     |
    | /questionnaires/getByCodes      | GET     |                                       | Array van vragenlijsten welke zijn gekoppeld aan de codes.                               |
    | /questionnaires/{code}          | GET     | code: code van de participant         | Een vragenlijst met daarbij de onderdelen en vragen.                                     |
    | /questionnaires/{questionnaire} | POST    | questionnaire: ID van een vragenlijst | 406 - Not implemented                                                                    |
    | /questions/{question}/{code}    | GET     | question: ID van de vraag             | Een vraag met daarbij de antwoordmogelijkheden en gegeven antwoorden door de participant |
    |                                 |         | code: code van de participant         |                                                                                          |
    | /questions/{question}/{code}    | POST    | question: ID van de vraag             | 406 - Not implemented.                                                                   |
    |                                 |         | code: code van de participant         |                                                                                          |

</details>

### Request

Voor een request moet je het volgende instellen<br>
De header bevat de volgende onderdelen:

-   `Content-Type` is `application/json`
-   `Accept` is `application/json`
-   `X-API-Key` moet de API key bevatten.

### Body

Voor de `/questionnaires/getByCodes` moet je een body meegeven.<br>
De body kan er als volgt uitzien:

```
{
    "codes": [
        "011362e4db517e348c713870f0270c04",
        "031ff84c2be935fb1d9cc6cfd9805ced",
    ]
}
```

### Response

Elke response wordt teruggeven in een `json` formaat.

<details>
    <summary>GET: /ping</summary>
    "pong"
</details>

<details>
    <summary>GET: /questionnaires/getByCodes</summary>

    [
        {
            "id": 1,
            "research_id": 1,
            "title": "Torp-Moen",
            "description": "Aut odit itaque adipisci at. At in tenetur tempora natus labore rem. Necessitatibus odio quae et quod.",
            "instructions": null,
            "open": true,
            "teachable_machine_link": "howell.info",
            "created_at": "2022-04-03T19:17:30.000000Z",
            "updated_at": "2022-04-03T19:17:30.000000Z"
        }
    ]

</details>

<details>
    <summary>GET: /questionnaires/{code}</summary>

    {
        "id": 1,
        "research_id": 1,
        "title": "Torp-Moen",
        "description": "Aut odit itaque adipisci at. At in tenetur tempora natus labore rem. Necessitatibus odio quae et quod.",
        "instructions": null,
        "open": true,
        "teachable_machine_link": "howell.info",
        "created_at": "2022-04-03T19:17:30.000000Z",
        "updated_at": "2022-04-03T19:17:30.000000Z",
        "sections": [
            {
                "id": 1,
                "questionnaire_id": 1,
                "geofence_id": 1,
                "title": "Korey Vista",
                "description": "Earum vitae dolore aut. Ipsum officiis sit qui sed. Mollitia consequuntur recusandae temporibus quo qui quas tempore. Qui molestiae voluptatem veritatis ipsum placeat ea quisquam.",
                "location_description": "8929 Gutkowski Corners\nAngelaport, NJ 06587",
                "teachable_machine_class": "Korey Vista",
                "created_at": "2022-04-03T19:17:30.000000Z",
                "updated_at": "2022-04-03T19:17:30.000000Z",
                "questions": [
                    {
                        "id": 1,
                        "section_id": 1,
                        "title": "Mr.",
                        "question": "Prof.",
                        "created_at": "2022-04-03T19:17:30.000000Z",
                        "updated_at": "2022-04-03T19:17:30.000000Z"
                    }
                ]
            }
        ]
    }

</details>

<details>
    <summary>POST: /questionnaires/{questionnaire}</summary>

    {
        "message": "Deze functie werkt nog niet."
    }

</details>

<details>
    <summary>GET: /questions/{question}/{code}</summary>

    {
        "id": 1,
        "section_id": 1,
        "title": "Mr.",
        "question": "Prof.",
        "created_at": "2022-04-03T19:17:30.000000Z",
        "updated_at": "2022-04-03T19:17:30.000000Z",
        "options": [
            {
                "id": 2,
                "question_id": 1,
                "type": "DATE",
                "extra_data": [],
                "created_at": "2022-04-03T19:17:30.000000Z",
                "updated_at": "2022-04-03T19:17:30.000000Z",
                "answers": [
                    {
                        "id": 7,
                        "participant_id": 1,
                        "question_option_id": 2,
                        "answer": "[]",
                        "created_at": "2022-04-03T19:17:30.000000Z",
                        "updated_at": "2022-04-03T19:17:30.000000Z"
                    }
                ]
            }
        ]
    }

</details>

<details>
    <summary>POST: /questions/{question}/{code}</summary>

    {
        "message": "Deze functie werkt nog niet"
    }

</details>

## Components

### Input

#### Text

```
@php
$extraData=array(
'before' => '$',
'after' => '.00'
);
@endphp
<x-input type="text" name="input" placeholder="input" :extraData="$extraData"></x-input>
```

#### Password

`<x-input type="password" name="input" placeholder="input"></x-input>`

#### Select

```
@php
    $extraData=array(
        'multiple' => true,
        'options' => [
          ['option_1', 'value_1'],
          ['option_2', 'value_2'],
          ['option_3', 'value_3'],
        ]
    );
@endphp
<x-input label="test" type="select" name="selectList" :extraData="$extraData" :value="['value_1', 'value_3']"></x-input>
```

#### Dates

```
<x-input type="date" name="input" value="2021-03-21"></x-input>
```

```
<x-input type="datetime" name="input" value="2021-03-21T08:00"></x-input>
```

#### Switch

`<x-input type="switch" name="input" :value="true"></x-input>`

#### Range

```
@php
    $extraData=array(
        'min' => 0,
        'max' => 5,
        'step' => 0.5
    );
@endphp
<x-input type="range" name="input" :extraData="$extraData" :value="1.5"></x-input>
```

#### File

```
@php
$extraData=array(
    'multiple' => false,
);
@endphp
<x-input type="file" name="input" :extraData="$extraData"></x-input>
```

### Buttons

Verschillende types zijn: primary, seocndary en remove.\
Je kan of een submit knop maken, je hoeft dan alleen het type mee te geven.\
`<x-button class="mx-4" type="primary">Press me</x-button>`\
Of je kan een link ervan maken en dan moet je nog de link meegeven.\
` <x-button class="mx-4" type="primary" link="https://www.google.com">Press me</x-button>`

### Table

Dit component kan je gebruiken voor een tabel:<br>
`<x-table :headers="$headers" :items="$items" :keys="$keys" :rowLink="$rowLink" :tableLinks="$tableLinks"/>`

#### Headers

De headers zijn een `array` waarbij het alleen is toegestaan om te werken met `strings`.

<span style="color: green">goed:</span> `$headers = ['header_1','header_2']`<br>
<span style="color: red">fout:</span>&nbsp;&nbsp;&nbsp;`$headers = [1,true]`
<br>
<br>

#### Items

De items zijn een `array` van verschillende items. Hierbij mag de omsluitende array alleen maar array's bevatten.

<span style="color: green">goed:</span>

```
$items = [
    [
        'id' => 1,
        'name' => 'Martijn',
        'age' => 20,
    ],
    [
        'id' => 2,
        'name' => 'Martijn_two',
        'age' => 180,
    ]
];
```

<span style="color: red">fout:</span>

```
$items = [
    'id' => 1,
    'name' => 'Martijn',
    'age' => 20,
    [
        'id' => 2,
        'name' => 'Martijn_two',
        'age' => 180,
    ]
];
```

<br>
<br>

#### Keys

De keys kunnen in een `array` van `strings` worden meegegeven.<br>
`$keys = ['key_one', 'key_two'];`<br><br>

Mocht je `item` er zo uitzien:

```
$item = [
    'id' => 1,
    'sub_item' => [
        'id' = 1,
    ],
]
```

dan is de `id` van het `sub_item` als volgt op te halen:
`$keys = ['id.sub_item.id', 'key_two'];`<br>

DIT WERKT NOG NIET VOOR EEN SUB ITEM MET MEERDERE ARRAYS.

<br><br>

#### TableLinks

`Tabelinks` zijn dynamisch gemaakt door een `collection` van de klasse `TableLink` te maken.

```
$tableLinks = collect($tableLink_one, $tableLink_two);
```

<br><br>

#### Simpele `TableLink`

De link van naar een pagina wordt gemaakt op basis van de Laravel `Route::class`.
De naam in de link wordt gemaakt op basis van een `defaults` variable `display` bij de route.

Om een naam te geven aan een url voeg je deze code toe aan je route:<br>
`->defaults('display', 'home')`<br>

Dan ziet je route er bijvoorbeeld als volgt uit:<br>

```
Route::get('/', function () {
  return view('welcome');
})->name('welcome')->defaults('display', 'home');
```

Dan ziet een `TableLink` er als volgt uit:

```
use App\Utils\TableLink;

$tableLink = new TableLink('welcome`)
```

<br><br>

#### `TableLink` met gegeven parameters

Om parameters voor een route mee te geven maak je gebruik van de `TableLinkParameter` klasse.
<br><br>
Stel je route ziet er als volgt uit:<br>

```
Route::get('/fake-route/{fake_param_one}')
->name('fake.route.with.one.param')->defaults('display', 'fake');
```

dan ziet je `TableLinkParameter` er zo uit:

```
use App\Utils\TableLinkParameter;

// Let goed op de parameters die je meegeeft, deze MOET je bij naam meegeven!
$tableLinkParameter_one = new TableLinkParameter(
    routeParameter: 'fake_param_one',
    routeValue: '321'
);
```

en deze geef je als volgt mee aan je `TableLink`.

```
$tableLinkParameters = collect([
    $tableLinkParameter_one
]):

$tableLink = new TableLink(
    'fake.route.with.one.param`,
    $tableLinkParameters
);
```

<br><br>

#### `TableLink` met NIET gegeven parameters

Mocht een link veranderen per item
(omdat je naar een bepaalde details pagina van een item wilt navigeren)
dan kan je dit als volgt doen.

Stel je `item` ziet er als volgt uit:

```
$item = [
    'item_id' => 9876,
    'name' => 'Martijn',
];
```

Dan ziet je `TableLinkParameter` er als volgt uit:

```
use App\Utils\TableLinkParameter;

// Let goed op de parameters die je meegeeft, deze MOET je bij naam meegeven!
$tableLinkParameter_one = new TableLinkParameter(
    routeParameter: 'fake_param_one',
    itemIndex: 'item_id'
);
```

hierdoor zal per tabelrij worden gezocht naar de juiste waarde voor de parameter.

Ook deze `TableLinkParameter` geef je als volgt mee aan de `TableLink`:

```
$tableLinkParameters = collect([
    $tableLinkParameter_one
]):

$tableLink = new TableLink(
    'fake.route.with.one.param`,
    $tableLinkParameters
)
```

<br><br>

#### Rowlink (wanneer je op de tabelrij drukt)

De rowlink is een `TableLink` en deze kan je ook als `TableLink` meegeven.

Voorbeeld:
`$rowLink = new TableLink('welcome');`

<br><br><br>

### Breadcrumbs

Een breadcrumb instellen is heel simpel.

Voeg deze code toe aan de view:<br>
`<x-breadcrumb />`

Om een naam te geven aan een url voeg je deze code toe aan je route:<br>
`->defaults('display', 'home')`<br>
Dan zie je route er bijvoorbeeld als volgt uit:<br>

```
Route::get('/', function () {
  return view('welcome');
})->name('welcome')->defaults('display', 'home');
```

Mocht je geen specifieke naam willen voor je route
(omdat er bijv een ID in zit verwerkt)
dan hoef je bovenstaande code niet te gebruiken.

Voorbeeld:<br>

```
Route::get('/users/{id}', function () {
  return view('users.details');
})->name('users.details');
```

Dan wordt de naam van je breadcrumb het {id} (bijvoorbeeld: `1`)

De rest is magie 🤯

### Tabs

Geef een lijst met tabs mee aan het component en de tab die actief is. Geef de sections dezelfde naam als de namen in de meegegeven lijst. Het component zorgt er met javascript voor dat de juiste section wordt getoond.

```angular2html
@extends('layouts.app')
@section('content')
    <h1>Welcome to this page</h1>
    <x-tabs :tabs="['Details', 'Vragenlijsten']">
        @section('Details')
            Details
        @endsection
        @section('Vragenlijsten')
            Vragenlijsten
        @endsection
    </x-tabs>
@endsection
```
