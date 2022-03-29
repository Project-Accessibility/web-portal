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

## Components

### Input

#### Text

`<x-input type="text" name="input" placeholder="input"></x-input>`

#### Password

`<x-input type="password" name="input" placeholder="input"></x-input>`

#### Select

```
@php
    $extraData=array(
        'multiple' => false
        'options' => [
          ['option_1', 'value_1'],
          ['option_2', 'value_2'],
        ];
    );
@endphp
<x-input type="select" name="input" :extraData="$extraData" value="waarde2"></x-input>
```

#### Dates

`<x-input type="date" name="input" value="2021-03-21"></x-input>`
` <x-input type="datetime" name="input" value="2021-03-21T08:00"></x-input>`

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

### Buttons

Verschillende types zijn: primary, seocndary en remove.\
Je kan of een submit knop maken, je hoeft dan alleen het type mee te geven.\
`<x-button class="mx-4" type="primary">Press me</x-button>`\
Of je kan een link ervan maken en dan moet je nog de link meegeven.\
` <x-button class="mx-4" type="primary" link="https://www.google.com">Press me</x-button>`

### Table

Dit component kan je gebruiken voor een tabel:<br>
`<x-table :headers="$headers" :items="$items" :keys="$keys" :tableLinks="$tableLinks"/>`

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

Stel je route ziet er als volgt uit:<br>

```
Route::get('/fake-route')
->name('fake.route.without.params');
```

Dan ziet een `TableLink` er als volgt uit:

```
use App\Utils\TableLink;

$tableLink = new TableLink(
    name: 'Deze naam komt in de knop te staan',
    route: 'link.naar.pagina`
)
```

<br><br>

#### `TableLink` met gegeven parameters

Om parameters voor een route mee te geven maak je gebruik van de `TableLinkParameter` klasse.
<br><br>
Stel je route ziet er als volgt uit:<br>

```
Route::get('/fake-route/{fake_param_one}')
->name('fake.route.with.one.param');
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
    name: 'Deze naam komt in de knop te staan',

    route: 'fake.route.with.one.param`,
    parameters: $tableLinkParameters
)
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
    name: 'Deze naam komt in de knop te staan',

    route: 'fake.route.with.one.param`,
    parameters: $tableLinkParameters
)
```
