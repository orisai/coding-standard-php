# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased](https://github.com/orisai/coding-standard-php/compare/1.1.2...HEAD)

### Changed

- PHPStorm / IntelliJ IDEA files
	- update php code style to better match rulesets

## [1.1.2](https://github.com/orisai/coding-standard-php/compare/1.1.1...1.1.2) - 2021-02-02

### Removed

- `Squiz.Commenting.FunctionComment.InvalidNoReturn`
	- not compatible with never returning types defined by phpstan and psalm

## [1.1.1](https://github.com/orisai/coding-standard-php/compare/1.1.0...1.1.1) - 2020-12-07

### Added

- PHPStorm / IntelliJ IDEA files
	- `composer.json` template

### Removed

- PHPStorm / IntelliJ IDEA files
	- phpdoc param and return type filters (because any type can be generic we don't know which are useless)

## [1.1.0](https://github.com/orisai/coding-standard-php/compare/1.0.0...1.1.0) - 2020-11-26

### Added

- Sniff `Generic.Arrays.DisallowLongArraySyntax`
- PHPStorm / IntelliJ IDEA files
    - empty class, interface and trait doc comments to override useless defaults
    - inline field doc comment (matches property doc comment) for multiple IDE versions compatibility

### Removed

- Sniff `Squiz.Strings.DoubleQuoteUsage.ContainsVar` - Double quoted strings with variables are allowed

## [1.0.0](https://github.com/orisai/coding-standard-php/releases/tag/1.0.0) - 2020-11-10

### Added

- Rulesets for PHP 7.1, 7.2, 7.3 and 7.4
- .editorconfig snippet
- PHPStorm / IntelliJ IDEA files
    - php code style
    - file and code templates
