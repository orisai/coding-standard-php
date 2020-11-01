# Coding Standard - PHP

PHP coding standard built on top of [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) and [Slevomat Coding Standard](https://github.com/slevomat/coding-standard) rules.

## Content
- [Setup](#setup)
- [Run CodeSniffer](#run-codesniffer)
- [Suppressing rules](#suppressing-rules)
	- [Suppress rule locally](#suppress-rule-locally)
	- [Suppress rule in a path](#suppress-rule-in-a-path)
	- [Suppress rule entirely](#suppress-rule-entirely)
- [Potential errors](#potential-errors)
- [EditorConfig](#editorconfig)
- [PhpStorm](#phpstorm)

## Setup

1. Install with `composer require --dev orisai/coding-standard`
2. Create `phpcs.xml` in root of your project
	- Or wherever you want, just modify paths (starting with ./) in xml file then.
3. Insert following content
	```xml
	<ruleset
		xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		xsi:noNamespaceSchemaLocation="./vendor/squizlabs/php_codesniffer/phpcs.xsd">

		<!-- Show only relevant part of path -->
		<arg name="basepath" value="./"/>

		<!-- Configure cache -->
		<arg name="cache" value="./var/build-tools/codesniffer.dat"/>

		<!-- Import coding-standard -->
		<rule ref="./vendor/orisai/coding-standard/src/ruleset-<VERSION>.xml"/>

		<!-- Configure PSR-4 rule -->
		<rule ref="SlevomatCodingStandard.Files.TypeNameMatchesFileName">
			<properties>
				<property name="rootNamespaces" type="array">
					<element key="src" value="<NAMESPACE>"/>
					<element key="tests" value="Tests\<NAMESPACE>"/>
				</property>
			</properties>
		</rule>
	</ruleset>
	```
4. Replace `<VERSION>` with minimal php version you want to support
	- supported are `7.1`, `7.2`, `7.3`, `7.4`
5. Replace `<NAMESPACE>` with your root namespace
	- by default expected code directory is `src` and tests directory is `tests` with `Tests` namespace prefix
6. Create directory for temp files
	- by default is expected to be `var/build-tools`

## Run CodeSniffer

Check code

`vendor/bin/phpcs --standard=phpcs.xml src tests`

Fix errors

`vendor/bin/phpcbf --standard=phpcs.xml src tests`

## Suppressing rules

You can always suppress rules instead of fixing the errors. Rules can be suppressed either locally, in path or entirely for project.

`vendor/bin/phpcs` outputs all errors like this:

```text
FILE: src/Example.php
---------------------------------
FOUND 1 ERROR AFFECTING 1 LINE
---------------------------------
 1 | ERROR | An error message.
   |       | (Name.Of.The.Sniff)
---------------------------------
```

The `Name.Of.The.Sniff` printed in brackets under the error is the string which can be used to suppress the sniff, as described below.

### Suppress rule locally

You can suppress rules by specific comments inside file, either for the whole file or part of it.

Suppress all rules in whole file

```php
<?php
// phpcs:ignoreFile
```

Suppress rules in code between `phpcs:disable` and `phpcs:enable`

```php
// phpcs:disable
echo 'some php code';
// phpcs:enable
```

```php
// phpcs:disable Name.Of.The.Sniff
echo 'some php code';
// phpcs:enable Name.Of.The.Sniff
```

Suppress rules on current and next line

```php
// phpcs:ignore
echo 'some php code';
```

```php
// phpcs:ignore Name.Of.The.Sniff
echo 'some php code';
```

Learn more in [PHP_CodeSniffer docs](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Advanced-Usage#ignoring-parts-of-a-file)

### Suppress rule in a path

Suppress specific rule in a path

```xml
<ruleset>
	<rule ref="Name.Of.The.Sniff">
		<exclude-pattern>src/Example\.php</exclude-pattern>
	</rule>
</ruleset>
```

You can also suppress all rules in a path

```xml
<ruleset>
	<exclude-pattern>path/to/directory</exclude-pattern>
</ruleset>
```

The `<exclude-pattern>` is treated like a regular expression
- ensure that `.` (`.php`) is escaped (`\.php`)
- `*` is converted to `.*`
- learn more in [PHP_CodeSniffer docs](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Advanced-Usage#ignoring-files-and-folders)

```xml
<ruleset>
	<exclude-pattern>src/*Test\.php</exclude-pattern>
</ruleset>
```

### Suppress rule entirely

Inside of the coding standard importing rule you can suppress the rules it imports entirely

```xml
<ruleset>
	<rule ref="./vendor/orisai/coding-standard/src/ruleset-7.4.xml">
		<exclude name="Name.Of.The.Sniff"/>
	</rule>
</ruleset>
```

## Potential errors

Sniffs listed bellow add typehints independently of whether it is allowed by inheritance rules or not.

`SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint`
- Adds function parameter type based on annotation typehint
- In `slevomat/coding-standard < 6.0` was `SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint`

`SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingNativeTypeHint`
- Adds function return type based on annotation typehint
- In `slevomat/coding-standard < 6.0` was `SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint`

`SlevomatCodingStandard.TypeHints.PropertyTypeHint`
- Adds property type based on annotation typehint
- php 7.4+

It may lead to php errors which must be suppressed. These sniffs specifically can be suppressed with `@phpcsSuppress` annotation.

```php
class Example extends ClassNotDeclaringTheTypes
{

	/**
	 * @var int
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint
	 */
	protected $exampleProperty;

	/**
	 * @param int $example
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
	 * @return int
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingNativeTypeHint
	 */
	protected function exampleMethod($example)
	{
		return $example;
	}

}
```

## EditorConfig

In case you use [EditorConfig](https://editorconfig.org), here is an easy preset, compatible with our coding standard

```.editorconfig
root = true

[*]
charset = utf-8
end_of_line = lf
insert_final_newline = true
trim_trailing_whitespace = true
indent_style = tab
indent_size = 4

[**.{yaml, yml}]
indent_style = space
indent_size=2
```

## PhpStorm

For [PhpStorm](https://www.jetbrains.com/phpstorm/) IDE is available config compatible with our coding standard.

To use it, navigate to *Settings > Editor > Code Style > PHP* and choose *Import scheme* option in dropdown menu and select
config file from *src/phpstorm/php-config.xml* in package directory.
