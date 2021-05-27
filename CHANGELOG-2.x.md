# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased](https://github.com/orisai/coding-standard-php/compare/2.1.0...HEAD)

## [2.1.0](https://github.com/orisai/coding-standard-php/compare/2.0.0...2.1.0) - 2021-05-27

### Changed

- Constructor property promotion is required
	- Replaced `SlevomatCodingStandard.Classes.DisallowConstructorPropertyPromotion` by `SlevomatCodingStandard.Classes.RequireConstructorPropertyPromotion`

## [2.0.0](https://github.com/orisai/coding-standard-php/compare/1.2.0...2.0.0) - 2021-05-08

### Added

- Compatibility with slevomat/coding-standard v7
- Ruleset for PHP 8.0
- Sniff `SlevomatCodingStandard.TypeHints.PropertyTypeHintSpacing`
- Sniff `SlevomatCodingStandard.Arrays.SingleLineArrayWhitespace`
- Sniff `SlevomatCodingStandard.Classes.ClassMemberSpacing`
- Sniff `SlevomatCodingStandard.Files.LineLength`
