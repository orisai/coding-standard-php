# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased](https://github.com/orisai/coding-standard-php/compare/2.4.1...HEAD)

## [2.4.1](https://github.com/orisai/coding-standard-php/compare/2.4.0...2.4.1) - 2022-06-13

### Fixed

- `phpstan/phpdoc-parser` locked to `~1.5.1` to prevent compatibility issue of `~1.6.0` and `slevomat/coding-standard`

## [2.4.0](https://github.com/orisai/coding-standard-php/compare/2.3.0...2.4.0) - 2022-05-06

### Added

- `SlevomatCodingStandard.Functions.DisallowTrailingCommaInCall`
	- Trailing comma is forbidden in single-line calls
- `SlevomatCodingStandard.Functions.RequireTrailingCommaInClosureUse`
	- Trailing comma is required in multi-line Closure `use()`
- `SlevomatCodingStandard.Functions.DisallowTrailingCommaInDeclaration`
	- Trailing comma is forbidden in single-line declarations

### Removed

- `Generic.NamingConventions.UpperCaseConstantName`
  - Constants names don't require any convention (preferably use PascalCase)

## [2.3.0](https://github.com/orisai/coding-standard-php/compare/2.2.3...2.3.0) - 2022-03-29

### Added

- `SlevomatCodingStandard.Commenting.UselessInheritDocComment`
    - Remove `{@inheritDoc}`
    - For PHP >=8.0

## [2.2.3](https://github.com/orisai/coding-standard-php/compare/2.2.2...2.2.3) - 2022-03-29

### Removed

- `Traversable` type hint (e.g. `array<mixed>` instead of `array`) is not required
    - Removed for properties, parameters and return types
    - Fully covered by PHPStan rules
    - Allows to completely drop `{@inheritDoc}` annotations (at least for PHP >=8.0 with `mixed` type)

## [2.2.2](https://github.com/orisai/coding-standard-php/compare/2.2.1...2.2.2) - 2022-02-15

### Added

- `PSR2.Methods.FunctionClosingBrace` - remove empty lines before function closing brace

## [2.2.1](https://github.com/orisai/coding-standard-php/compare/2.2.0...2.2.1) - 2021-08-01

### Changed

- Fix collision of `SlevomatCodingStandard.ControlStructures.RequireSingleLineCondition`
  and `SlevomatCodingStandard.Functions.RequireMultiLineCall` sniffs
    - `RequireSingleLineCondition` does not require simple conditions to be single line

## [2.2.0](https://github.com/orisai/coding-standard-php/compare/2.1.1...2.2.0) - 2021-08-01

### Added

- Order and group most useful annotations
	- Via sniff `SlevomatCodingStandard.Commenting.DocCommentSpacing`

## [2.1.1](https://github.com/orisai/coding-standard-php/compare/2.1.0...2.1.1) - 2021-07-31

### Changed

- Sniff `SlevomatCodingStandard.Namespaces.UnusedUses` ignores case of annotations with the highest probability to
  collide with class names.

## [2.1.0](https://github.com/orisai/coding-standard-php/compare/2.0.0...2.1.0) - 2021-05-27

### Changed

- Constructor property promotion is required
	- Replaced `SlevomatCodingStandard.Classes.DisallowConstructorPropertyPromotion`
	  by `SlevomatCodingStandard.Classes.RequireConstructorPropertyPromotion`

## [2.0.0](https://github.com/orisai/coding-standard-php/compare/1.2.0...2.0.0) - 2021-05-08

### Added

- Compatibility with slevomat/coding-standard v7
- Ruleset for PHP 8.0
- Sniff `SlevomatCodingStandard.TypeHints.PropertyTypeHintSpacing`
- Sniff `SlevomatCodingStandard.Arrays.SingleLineArrayWhitespace`
- Sniff `SlevomatCodingStandard.Classes.ClassMemberSpacing`
- Sniff `SlevomatCodingStandard.Files.LineLength`
