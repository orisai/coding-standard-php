# Coding Standard - PHP

PHP coding standard built on top of [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
and [Slevomat Coding Standard](https://github.com/slevomat/coding-standard) rules.

## Content

- [Setup](#setup)
- [Run CodeSniffer](#run-codesniffer)
- [Suppressing rules](#suppressing-rules)
	- [Suppress rule locally](#suppress-rule-locally)
	- [Suppress rule in a path](#suppress-rule-in-a-path)
	- [Suppress rule entirely](#suppress-rule-entirely)
- [Code-breaking sniffs](#code-breaking-sniffs)
- [EditorConfig](#editorconfig)
- [PhpStorm / IntelliJ IDEA](#phpstorm--intellij-idea)
	- [Code style](#code-style)
	- [File and code templates](#file-and-code-templates)

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
		<arg name="cache" value="./var/tools/PHP_CodeSniffer/cache.dat"/>

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
	- supported are `7.2`, `7.3`, `7.4`, `8.0`, `8.1`, `8.2`, `8.3`
5. Replace `<NAMESPACE>` with your root namespace
	- by default expected code directory is `src` and tests directory is `tests` with `Tests` namespace prefix
6. Create directory for temp files
	- `phpcs.xml` from example expects directory `var/tools/PHP_CodeSniffer` (see `<arg name="cache"`)

## Run CodeSniffer

Check code

`vendor/bin/phpcs --standard=phpcs.xml src tests`

Fix errors

`vendor/bin/phpcbf --standard=phpcs.xml src tests`

## Suppressing rules

You can always suppress rules instead of fixing the errors. Rules can be suppressed either locally, in path or entirely
for project.

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

The `Name.Of.The.Sniff` printed in brackets under the error is the string which can be used to suppress the sniff, as
described below.

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

Learn more in
[PHP_CodeSniffer docs](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Advanced-Usage#ignoring-parts-of-a-file)

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
- learn more in
  [PHP_CodeSniffer docs](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Advanced-Usage#ignoring-files-and-folders)

```xml
<ruleset>
	<exclude-pattern>src/*Test\.php</exclude-pattern>
</ruleset>
```

### Suppress rule entirely

Inside of the coding standard importing rule you can suppress the rules it imports entirely

```xml
<ruleset>
	<rule ref="Namespace.Sniff">
		<exclude name="Namespace.Sniff"/>
		<!-- OR -->
		<exclude name="Namespace.Sniff.SpecificError"/>
	</rule>
</ruleset>
```

## Code-breaking sniffs

These sniffs may break code due to incorrect phpdoc types or parent class/interface lacking native types.

If you are not ready to use them, just disable them entirely:

```xml
<ruleset>
	<!-- Excluded because they are unsafe to auto-fix without tests or passing static analysis (e.g. PHPStan) -->

	<!-- Adds declare(strict_types=1) -->
	<!-- Unsafe when code is not strict types compatible -->
	<rule ref="SlevomatCodingStandard.TypeHints.DeclareStrictTypes.DeclareStrictTypesMissing">
		<exclude name="SlevomatCodingStandard.TypeHints.DeclareStrictTypes.DeclareStrictTypesMissing"/>
	</rule>

	<!-- Adds property type based on annotation typehint -->
	<!-- Unsafe for overridden properties and properties with incorrect phpdoc type -->
	<rule ref="SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint">
		<exclude name="SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint"/>
	</rule>

	<!-- Adds function parameter type based on annotation typehint -->
	<!-- Unsafe for overridden third-party methods and methods with incorrect parameter phpdoc type -->
	<rule ref="SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint">
		<exclude name="SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint"/>
	</rule>

	<!-- Adds function return type based on annotation typehint -->
	<!-- Unsafe for overridden third-party methods and methods with incorrect return phpdoc type -->
	<rule ref="SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingNativeTypeHint">
		<exclude name="SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingNativeTypeHint"/>
	</rule>

	<!-- Replaces inline phpdoc with assert() when possible -->
	<!-- Unsafe with incorrect phpdoc types -->
	<rule ref="SlevomatCodingStandard.PHP.RequireExplicitAssertion">
		<exclude name="SlevomatCodingStandard.PHP.RequireExplicitAssertion"/>
	</rule>

	<!-- Makes anonymous closures static when $this is not used inside them -->
	<!-- May be unsafe if closure binding is used -->
	<rule ref="SlevomatCodingStandard.Functions.StaticClosure">
		<exclude name="SlevomatCodingStandard.Functions.StaticClosure"/>
	</rule>

	<!-- Causes changes in what PHPStan reports because PHPStan treats short and generic array syntax differently -->
	<!-- User[]|ICollection (iterable ICollection of User) -> array<User>|ICollection (union) -->
	<rule ref="SlevomatCodingStandard.TypeHints.DisallowArrayTypeHintSyntax">
		<exclude name="SlevomatCodingStandard.TypeHints.DisallowArrayTypeHintSyntax"/>
	</rule>
</ruleset>
```

Compatibility with specific untyped parent/interface properties, method parameters and method return types may be solved
by local ignores:

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

Closures using binding to an instance cannot be static and must be ignored by static closure sniff:

```php
// phpcs:disable SlevomatCodingStandard.Functions.StaticClosure
(fn () => $object->$name = $value)
	->bindTo($object, get_class($object))();
// phpcs:enable
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

To use our code style options, navigate to [*File | Settings | Editor | Code Style |
PHP*](jetbrains://PhpStorm/settings?name=Editor--Code+Style--PHP),
choose *Import scheme* option in dropdown menu and select config file from *ide-config/.idea/php-config.xml* in package
directory.

### File and code templates

We offer code generation templates compatible with our coding standard. To use them, follow instructions:

- Navigate to [IDE configuration folder](https://www.jetbrains.com/help/phpstorm/tuning-the-ide.html#config-directory).
	- Or navigate to project `.idea` folder to set templates for project only.
- Copy into the folder the package `ide-config/.idea/fileTemplates` directory and override existing files.

Alternatively you can also import templates one by one via settings at
[*File | Settings | Editor | File and Code
Templates*](jetbrains://PhpStorm/settings?name=Editor--File+and+Code+Templates).
