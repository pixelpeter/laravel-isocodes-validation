# Changelog

All notable changes for the Laravel 12+ IsoCodes Validation will be documented in this file.

## v13.0.0 - 2026-09-17

Added support for Laravel 12 and 13.

From this release on, the package major version matches the highest Laravel major version it supports, so `^13.0` covers Laravel 13.x and 12.x. Development happens on `master`; the `v13.x` branch tracks it and carries the released state.

### Added

- Support for Laravel 13.x on PHP 8.5, 8.4 and 8.3.

### Changed

- `laravel/framework` is constrained to `^12.61.1|^13.0`, which excludes the framework versions affected by the published CRLF injection and temporary signed URL advisories.
- `ronanguilloux/isocodes` moves to `^2.4.1`.
- `orchestra/testbench` moves to `^10.0|^11.0`, `phpunit/phpunit` to `^12.5.8`, `phpstan/phpstan` to `^2.1` and `larastan/larastan` to `^3.7`.
- The test matrix covers Laravel 13.x and 12.x against PHP 8.5, 8.4 and 8.3. PHPStan runs on PHP 8.3, the lowest supported version.
- Workflow actions are up to date: `actions/checkout` v6, `git-auto-commit-action` v7, `laravel-pint-action` 2.6, `fetch-metadata` 2.5.0.
- `Update Changelog` now lets `peter-evans/create-pull-request` v8 commit and open the pull request on its own. The job needs no personal access token.

### Removed

- Support for Laravel 11.x and 10.x. Both are past their security support window, and Composer refuses to install them because of published security advisories.
- Support for PHP 8.2 and 8.1. Laravel 12 still runs on PHP 8.2, but that version reaches end of life in December 2026 and Laravel 13 requires PHP 8.3 or later.

### Upgrading

Require `^13.0` and make sure the application runs Laravel 12.61.1 or later on PHP 8.3 or later. No validation rule, message or configuration changed, so no application code needs touching. Applications on Laravel 11.x or 10.x stay on `v12.1.0`, which is deprecated and receives no further releases.

## v12.1.0 - 2025-09-12

**Deprecated.** This release supports Laravel 12.x, 11.x and 10.x and is no longer maintained. The Laravel 12.x line
continues in `v13.0.0`; there is no successor for Laravel 11.x and 10.x.

- Refactored the validator for less boilerplate and a clearer structure, splitting the registry, the reference
  resolver and the message replacer into `src/Support`.

## v12.0.0 - 2025-04-01

**Deprecated.** This release supports Laravel 12.x, 11.x and 10.x and is no longer maintained.

ADD: Laravel 12 compatibility

## v10.1.0 - 2024-10-14

**Deprecated.** The v10.x line supports Laravel 10.x and 11.x and is no longer maintained. There is no successor
release for those Laravel versions.

### What's Changed

* Add Spanish translations by @elcapo in https://github.com/pixelpeter/laravel-isocodes-validation/pull/2

### New Contributors

* @elcapo made their first contribution in https://github.com/pixelpeter/laravel-isocodes-validation/pull/2

**Full Changelog**: https://github.com/pixelpeter/laravel-isocodes-validation/compare/v10.0.0...v10.1.0

## v8.1.1 - 2024-10-14

**Deprecated.** The v8.x line supports Laravel 8.x and 9.x and is no longer maintained.

### What's Changed

* FIX: dependencies by @pixelpeter in https://github.com/pixelpeter/laravel-isocodes-validation/pull/8

**Full Changelog**: https://github.com/pixelpeter/laravel-isocodes-validation/compare/v8.1.0...v8.1.1

## v10.0.0 - 2024-10-14

### What's Changed

* UPDATE: add Laravel 11 compatibility by @pixelpeter in https://github.com/pixelpeter/laravel-isocodes-validation/pull/7

**Full Changelog**: https://github.com/pixelpeter/laravel-isocodes-validation/compare/v8.1.0...v10.0.0

## v8.1.0 - 2024-10-14

### What's Changed

* ADD: github actions by @pixelpeter in https://github.com/pixelpeter/laravel-isocodes-validation/pull/3
* FIX: dependencies by @pixelpeter in https://github.com/pixelpeter/laravel-isocodes-validation/pull/6

### New Contributors

* @pixelpeter made their first contribution in https://github.com/pixelpeter/laravel-isocodes-validation/pull/3

**Full Changelog**: https://github.com/pixelpeter/laravel-isocodes-validation/compare/v8.0.1...v8.1.0

## 8.0.1

- Fixed Class "pixelpeter\IsoCodesValidation\IsoCodesValidationServiceProvider" not found by MASNathan

## 8.0.0

- Laravel 8+ and php8 compatible version based on https://github.com/pixelpeter/laravel-isocodes-validation
