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
