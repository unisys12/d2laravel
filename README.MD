# D2 Laravel

Aims to give a good starting point for working with the Bungie Destiny 2 API within a Laravel Project.

## Provides

- Migrations to for your current database to setup tables for the following:
  - Manifest properties using key value pair style storage
  - `DestinyInventoryItemDefinition` => items
  - `DestinyCollectionDefinition` => collections
  - more to come...
- Models for each with relationships where applicable.
- Database Seeders for each table.
- Scheduled Job to check for updated Manifest
- Event that will fire on Manifest update that re-seeds database with updated info

## Setup

**Installation**
`composer require unisys12/d2laravel` _currently not on Packagist just yet_

**Config**
Add your Bungie API Key to your .env file, which is required to make requests against the API
`BUNGIE_KEY=<X-API-KEY>`

**Publish Migrations**
To get started, you need to publish the migrations for the tables. There will be a migration for each table, so...
`php artisan vendor:publish --provider="unisys12\D2Laravel\D2LaravelServiceProvider" --tag="migrations"`
I will most likely change this over to a cmd in the future or exchange using "migrations" as the tag and use an array of the available tables.

## Usage

Running `php artisan list` will expose each of the cmds available.

d2

- d2:check -> Check the current Manifest version
- d2:seed -> Seeds the selected tables in the preferred language
