# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased](https://github.com/orisai/coding-standard-php/compare/3.1.1...HEAD)

## [3.1.1](https://github.com/orisai/coding-standard-php/compare/3.1.0...3.1.1) - 2022-07-10

### Removed

- `SlevomatCodingStandard.Operators.DisallowEqualOperators` sniff
  - use `phpstan/phpstan-strict-rules` with bleeding edge instead

## [3.1.0](https://github.com/orisai/coding-standard-php/compare/3.0.0...3.1.0) - 2022-07-08

### Added

- `SlevomatCodingStandard.Classes.BackedEnumTypeSpacing` sniff
  - Checks number of spaces before `:` and before type.

### Changed

- `slevomat/coding-standard` upgraded to `^8.2.0`
- `SlevomatCodingStandard.Classes.PropertyDeclaration` sniff
  - Checks promoted properties
  - Checks number of spaces between property modifiers

## [3.0.0](https://github.com/orisai/coding-standard-php/compare/2.4.1...3.0.0) - 2022-06-17

### Added

- PHP 8.1 support

### Changed

- `slevomat/coding-standard` upgraded to `^8.0.0`

### Removed

- PHP 7.1 support
