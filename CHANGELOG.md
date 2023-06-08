# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased](https://github.com/orisai/coding-standard-php/compare/3.7.0...HEAD)

### Removed

- `PSR1.Classes.ClassDeclaration` sniff
  - superseded by optional `SlevomatCodingStandard.Files.TypeNameMatchesFileName` sniff
- `Generic.PHP.DeprecatedFunctions`
  - use `phpstan/phpstan-deprecation-rules` instead

## [3.7.0](https://github.com/orisai/coding-standard-php/compare/3.6.0...3.7.0) - 2023-05-14

### Added

- `SlevomatCodingStandard.Arrays.ArrayAccess` sniff

### Changed

- `slevomat/coding-standard` upgraded to `^8.12.0`

## [3.6.0](https://github.com/orisai/coding-standard-php/compare/3.5.0...3.6.0) - 2023-04-24

### Added

- `SlevomatCodingStandard.Commenting.AnnotationName` sniff

### Changed

- `slevomat/coding-standard` upgraded to `^8.11.0`

### Removed

- `SlevomatCodingStandard.Functions.StrictCall`
  - Use `phpstan/phpstan-strict-rules` instead

## [3.5.0](https://github.com/orisai/coding-standard-php/compare/3.4.0...3.5.0) - 2023-04-10

### Added

- `SlevomatCodingStandard.Classes.DisallowStringExpressionPropertyFetch` sniff
- `SlevomatCodingStandard.Strings.DisallowVariableParsing` sniff
- New Composer keywords to suggest --dev during require
- Forbidden function aliases:
  - `diskfreespace()` -> `disk_free_space()`
  - `ftp_quit` -> `ftp_close`
  - `get_required_files` -> `get_included_files`
  - `gzputs` -> `gzwrite`
  - `ldap_close` -> `ldap_unbind`
  - `ldap_modify` -> `ldap_mod_replace`
  - `msgpack_pack` -> `msgpack_serialize`
  - `msgpack_unpack` -> `msgpack_unserialize`
  - `odbc_do` -> `odbc_exec`
  - `odbc_field_precision` -> `odbc_field_len`
  - `openssl_get_privatekey` -> `openssl_pkey_get_private`
  - `openssl_get_publickey` -> `openssl_pkey_get_public`
  - `imap_create` -> `imap_createmailbox`
  - `imap_fetchtext` -> `imap_body`
  - `imap_header` -> `imap_headerinfo`
  - `imap_listmailbox` -> `imap_list`
  - `imap_listsubscribed` -> `imap_lsub`
  - `imap_rename` -> `imap_renamemailbox`
  - `imap_scan` -> `imap_listscan`
  - `imap_scanmailbox` -> `imap_listscan`
  - `pcntl_errno` -> `pcntl_get_last_error`
  - `posix_errno` -> `posix_get_last_error`
  - `read_exif_data` -> `exif_read_data`
  - `session_commit` -> `session_write_close`
  - `set_file_buffer` -> `stream_set_write_buffer`
  - `socket_getopt` -> `socket_get_option`
  - `socket_setopt` -> `socket_set_option`
  - `srand` -> `mt_srand`
  - `user_error` -> `trigger_error`

### Changed

- `slevomat/coding-standard` upgraded to `^8.10.0`

### Removed

- `delete()` as an alias of `unset()`, because it does not exist

## [3.4.0](https://github.com/orisai/coding-standard-php/compare/3.3.5...3.4.0) - 2023-03-28

### Added

- `SlevomatCodingStandard.Classes.EnumCaseSpacing` sniff
- `SlevomatCodingStandard.Classes.RequireSelfReference` sniff
- `SlevomatCodingStandard.ControlStructures.DisallowTrailingMultiLineTernaryOperator` sniff

### Changed

- `slevomat/coding-standard` upgraded to `^8.9.0`

## [3.3.5](https://github.com/orisai/coding-standard-php/compare/3.3.4...3.3.5) - 2023-02-07

### Changed

- Moved IntelliJ files from src/.idea to ide-config/.idea to prevent them being picked up by static analysis tools

## [3.3.4](https://github.com/orisai/coding-standard-php/compare/3.3.3...3.3.4) - 2022-12-12

### Removed

- `Squiz.Commenting.VariableComment.VarOrder` error
	- redundant and colliding with
	  superfluous `SlevomatCodingStandard.Commenting.DocCommentSpacing.IncorrectAnnotationsGroup`

## [3.3.3](https://github.com/orisai/coding-standard-php/compare/3.3.2...3.3.3) - 2022-12-09

### Changed

- Composer
	- allows PHP 8.2

## [3.3.2](https://github.com/orisai/coding-standard-php/compare/3.3.1...3.3.2) - 2022-11-04

### Added

- `SlevomatCodingStandard.Commenting.InlineDocCommentDeclaration` allows `@var` above `return`

## [3.3.1](https://github.com/orisai/coding-standard-php/compare/3.3.0...3.3.1) - 2022-11-03

### Added

- `SlevomatCodingStandard.Commenting.DocCommentSpacing` supports sorting of `assert`, `param-out`, `this-out`
  and `self-out` and their `phpstan-` and `psalm-` prefixed variants

### Removed
- `Generic.Commenting.DocComment`
  - redundant functions of superfluous `Squiz.WhiteSpace.SuperfluousWhitespace` and `SlevomatCodingStandard.Commenting.DocCommentSpacing`

## [3.3.0](https://github.com/orisai/coding-standard-php/compare/3.2.1...3.3.0) - 2022-10-05

### Added

- `SlevomatCodingStandard.Attributes.AttributeAndTargetSpacing` sniff
- `SlevomatCodingStandard.Attributes.DisallowAttributesJoining` sniff
- `SlevomatCodingStandard.Attributes.DisallowMultipleAttributesPerLine` sniff
- `SlevomatCodingStandard.Attributes.RequireAttributeAfterDocComment` sniff

### Changed

- `slevomat/coding-standard` upgraded to `^8.6.0`

## [3.2.1](https://github.com/orisai/coding-standard-php/compare/3.2.0...3.2.1) - 2022-10-05

### Changed

- `SlevomatCodingStandard.Files.LineLength`
  - ignores comments

## [3.2.0](https://github.com/orisai/coding-standard-php/compare/3.1.2...3.2.0) - 2022-09-22

### Added

- `SlevomatCodingStandard.PHP.RequireExplicitAssertion`
  - Option `enableIntegerRanges` is enabled
  - Option `enableAdvancedStringTypes` is enabled

### Changed

- `slevomat/coding-standard` upgraded to `^8.5.0`

## [3.1.2](https://github.com/orisai/coding-standard-php/compare/3.1.1...3.1.2) - 2022-07-17

### Removed

- `SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingAnyTypeHint`
	- use `phpstan/phpstan` instead
	- PHPStan does the same check *and* respects inheritance
- `SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingAnyTypeHint`
	- use `phpstan/phpstan` instead
	- PHPStan does the same check *and* respects inheritance

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
