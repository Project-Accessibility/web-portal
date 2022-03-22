# Project Accessibility Web Portal

[![DeepScan grade](https://deepscan.io/api/teams/17161/projects/20524/branches/562465/badge/grade.svg)](https://deepscan.io/dashboard#view=project&tid=17161&pid=20524&bid=562465)

[![Laravel Tests](https://github.com/Project-Accessibility/web-portal/workflows/Laravel/badge.svg)](https://github.com/Project-Accessibility/web-portal/actions/)
[![Prettier](https://github.com/Project-Accessibility/web-portal/workflows/Prettier/badge.svg)](https://github.com/Project-Accessibility/web-portal/actions/)

[![Okteto Dev](https://github.com/Project-Accessibility/web-portal/workflows/okteto-dev.yml/badge.svg)](https://github.com/Project-Accessibility/web-portal/actions/)
[![Okteto Acc](https://github.com/Project-Accessibility/web-portal/workflows/okteto-acc.yml/badge.svg)](https://github.com/Project-Accessibility/web-portal/actions/)

- [Project Accessibility Web Portal](#project-accessibility-web-portal)
  - [Requirements](#requirements)
  - [Development](#development)

## Requirements

- Node v16.13.0 or later
- NPM v8.5.4 or later
- Yarn v1.22.17 or later
- PHP 8.1 or later
- MySQL 8.0 or later
- Composer 2.2.7 or later

## Development

- Run `npm i -g yarn` to install yarn.
- Run `yarn prepare` to install GitHooks.
- Run `yarn watch` real-time compiling of CSS/JS files.
- Run `php artisan serve` to run the application.
- Run `./vendor/bin/sail up` to run the application in Docker.
- Run `php artisan migrate` to run the database migrations.
- Run `php artisan db:seed` to run the database seeders.
- Run `php artisan key:generate` to generate the application key.

## Components
### Input
#### Text
```<x-input type="text" name="input" placeholder="input"></x-input>```
#### Password
```<x-input type="password" name="input" placeholder="input"></x-input>```
#### Select
```
@php
    $extraData=(object)array(
        "options" => array("optie1", "optie2", "optie3"),
        "values" => array("waarde1", "waarde2", "waarde3")
    );
@endphp
<x-input type="select" name="input" :extraData="$extraData" value="waarde2"></x-input>
```
#### Dates
```<x-input type="date" name="input" value="2021-03-21"></x-input>```
``` <x-input type="datetime" name="input" value="2021-03-21T08:00"></x-input>```
#### Switch
```<x-input type="switch" name="input" :value="true"></x-input>```
#### Range
```
@php
    $extraData=(object)array(
        "min" => 0,
        "max" => 5,
        "step" => 0.5
    );
@endphp
<x-input type="range" name="input" :extraData="$extraData" :value="1.5"></x-input>
```
