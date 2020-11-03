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
    - [IDE compatibility](#ide-compatibility)
    - [Code-breaking sniffs](#code-breaking-sniffs)
- [EditorConfig](#editorconfig)
- [PhpStorm / IntelliJ IDEA](#phpstorm--intellij-idea)
    - [Code style](#code-style)
    - [File and code templates](#file-and-code-templates)
        - [PHP files](#php-files)
        - [Types - classes, interfaces, traits](#types---classes-interfaces-traits)
        - [Parent method override](#parent-method-override)
        - [Getters and setters](#getters-and-setters)
        - [Function phpdoc](#function-phpdoc)

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

### IDE compatibility

As we always use the newest features of each PHP version, ensure that your IDE is fully compatible with given PHP version.
You may need to suppress some sniffs otherwise.

We are using generics syntax for arrays instead array type hint syntax, some IDEs may not be compatible yet.
- eg. `array<int>`, `array<array<bool>>` is used instead of `int[]`, `bool[][]`
- Sniff `SlevomatCodingStandard.TypeHints.DisallowArrayTypeHintSyntax`
- Known compatible IDEs are:
    - PHPStorm / IntelliJ IDEA - since 2020.3

### Code-breaking sniffs

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

## PhpStorm / IntelliJ IDEA

For [PhpStorm](https://www.jetbrains.com/phpstorm/) IDE is available config compatible with our coding standard.

### Code style

To use our code style options, navigate to [*File | Settings | Editor | Code Style | PHP*](jetbrains://PhpStorm/settings?name=Editor--Code+Style--PHP),
choose *Import scheme* option in dropdown menu and select config file from *src/.idea/php-config.xml* in package directory.

### File and code templates

We offer code generation templates compatible with our coding standard. To use them, follow instructions:

- Navigate to [IDE configuration folder](https://www.jetbrains.com/help/phpstorm/tuning-the-ide.html#config-directory).
    - Or navigate to project `.idea` folder to set templates for project only.
- Copy into the folder the package `src/.idea/fileTemplates` directory and override existing files.

Alternatively you can also import templates one by one via settings at
[*File | Settings | Editor | File and Code Templates*](jetbrains://PhpStorm/settings?name=Editor--File+and+Code+Templates).

#### PHP files

Each PHP file is generated with following heading

```php
<?php declare(strict_types = 1);

namespace Example;
```

#### Types - classes, interfaces, traits

All types are generated in clean format compatible with coding standard.

```php
<?php declare(strict_types = 1);

namespace Example;

class Example
{

}
```

#### Parent method override

Overriding methods are generated with variable assignment in case method returns something.

```php
class ParentClass
{

	public function withReturn(string $string): string
	{
		return $string;
	}

	public function withoutReturn(string $string): void
	{
		echo $string;
	}

}

class ChildClass extends ParentClass
{

	public function withReturn(string $string): string
	{
		$result = parent::withReturn($string);

		return $result;
	}

	public function withoutReturn(string $string): void
	{
		parent::withoutReturn($string);
	}

}
```

#### Getters and setters

Getters and setters are generated with additional phpdoc only in case type cannot be written natively and can't provide additional info.
- Known limitations:
    - In case property phpdoc uses syntax which is not supported by IDE, e.g. generics syntax (`GenericClass<Example>` or `array<int>`)
    then method is generated without additional info from property phpdoc. For `array<anything>` is added `array<mixed>` instead.

```php
class GetSet
{

	/** @var string */
	private $nonFluent;

	/** @var string */
	private $fluent;

	/** @var string|int */
	private $multiType;

	/** @var array */
	private $array;

	/** @var bool */
	private $bool;

	/** @var string */
	private static $static;

	public function getNonFluent(): string
	{
		return $this->nonFluent;
	}

	public function setNonFluent(string $nonFluent): void
	{
		$this->nonFluent = $nonFluent;
	}

	/**
	 * @return $this
	 */
	public function setFluent(string $fluent): self
	{
		$this->fluent = $fluent;

		return $this;
	}

	/**
	 * @return int|string
	 */
	public function getMultiType()
	{
		return $this->multiType;
	}

	/**
	 * @param int|string $multiType
	 */
	public function setMultiType($multiType): void
	{
		$this->multiType = $multiType;
	}

	/**
	 * @return array<mixed>
	 */
	public function getArray(): array
	{
		return $this->array;
	}

	/**
	 * @param array<mixed> $array
	 */
	public function setArray(array $array): void
	{
		$this->array = $array;
	}

	public function isBool(): bool
	{
		return $this->bool;
	}

	public static function getStatic(): string
	{
		return self::$static;
	}

	public static function setStatic(string $static): void
	{
		self::$static = $static;
	}

}
```

#### Function phpdoc

Function phpdoc is generated with all parameters and thrown exceptions.
Return type is added only if it's not simple type which can be written natively (and matches `^[a-zA-Z0-9]+`).

```php
/**
 * @param int $min
 * @param int $max
 * @return Example|int|string
 * @throws Exception
 */
function multiReturnType(int $min, int $max)
{
	if (random_int($min, $max)) {
		return 123;
	} elseif (random_int($min, $max)) {
		return 'string';
	} elseif (random_int($min, $max)) {
		return new Example();
	}

	throw new Exception();
}

/**
 * @param int $min
 * @param int $max
 * @throws Exception
 */
function simpleReturnType(int $min, int $max): int
{
	if (random_int($min, $max)) {
		return 123;
	}

	throw new Exception();
}
```
