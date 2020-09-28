# Coding Standard - PHP

## Setup

1. Install with `composer require --dev orisai/coding-standard`
2. Create `phpcs.xml` in root of your project
3. Insert following content
	```xml
	<ruleset
			xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
			xsi:noNamespaceSchemaLocation="./vendor/squizlabs/php_codesniffer/phpcs.xsd">

		<!-- Show only relevant part of path -->
		<arg name="basepath" value="./"/>

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
	- currently supported are `7.1`, `7.2`, `7.3`, `7.4`
5. Replace `<NAMESPACE>` with your root namespace
	- by default is expected code directory is `src` and tests directory is `tests` and has namespace `Tests`
6. Create directory for temp files
	- by default is expected to be `var/tmp`

## Run codesniffer

Check code

`vendor/bin/phpcs --standard=phpcs.xml --cache=var/tmp/codesniffer.dat src tests`

Fix errors

`vendor/bin/phpcbf --standard=phpcs.xml --cache=var/tmp/codesniffer.dat src tests`

## Potential errors

These sniffs add typehints independently of whether it is allowed by inheritance rules or not.
You may need to add annotation `@phpcsSuppress` with sniff name to disable the check.

`SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint`
- Adds function parameter type based on annotation typehint
- Called `SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint` in `slevomat/coding-standard` < 6.0

`SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingNativeTypeHint`
- Adds function return type based on annotation typehint
- Called `SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint` in `slevomat/coding-standard` < 6.0

`SlevomatCodingStandard.TypeHints.PropertyTypeHint`
- Adds property type based on annotation typehint
