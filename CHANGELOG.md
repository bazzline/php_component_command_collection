# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Open]

### To Add

### To Change

## [Unreleased]

### Added

* added latest release version in the README.md

### Changed

## [1.0.0](https://github.com/bazzline/php_component_command_collection/tree/1.0.0) - released at 2018-01-14

### Added

* Lots of [examples](example).

### Changed

* dropped support for php version below 7.0
* removed development dependencies to mockery and phpunit since no tests are needed
* removed .travis.yml since there is nothing to test

## [0.1.0](https://github.com/bazzline/php_component_command_collection/tree/0.1.0) - released at 2017-05-27

### Added

* added link to the api

### Changed

* dropped support for php version below 5.6
* moved release history to changelog
* relaxed vfsstream development requirement

## [0.0.11](https://github.com/bazzline/php_component_command_collection/tree/0.0.11) - released at 2016-02-22

### Changed

* moved to psr-4 autoloading
* updated dependencies

## [0.0.10](https://github.com/bazzline/php_component_command_collection/tree/0.0.10) - released at 2015-09-20

### Changed

* added optional *$data* to *Curl::delete*

## [0.0.9](https://github.com/bazzline/php_component_command_collection/tree/0.0.9) - released at 2015-09-18

### Changed

* all available commands are now extending from *AbstractCommand*
* updated dependencies

## [0.0.8](https://github.com/bazzline/php_component_command_collection/tree/0.0.8) - released at 2015-09-18

### Added

* added install howto to readme

### Changed

* updated dependencies

## [0.0.7](https://github.com/bazzline/php_component_command_collection/tree/0.0.7) - released at 2015-09-16

### Changed

* replaced behavior of "Curl::noSslSecurity" and added "Curl::noSslRevoke"

## [0.0.6](https://github.com/bazzline/php_component_command_collection/tree/0.0.6) - released at 2015-09-14

### Changed

* updated dependency

## [0.0.5](https://github.com/bazzline/php_component_command_collection/tree/0.0.5) - released at 2015-09-12

### Added

* added [Http/Curl](https://github.com/bazzline/php_component_command_collection/blob/master/source/Net/Bazzline/Component/CommandCollection/Http/Curl.php)

## [0.0.4](https://github.com/bazzline/php_component_command_collection/tree/0.0.4) - released at 2015-06-05

### Changed

* replaced "/usr/bin/<command>" with "/usr/bin/env <command>" to extend compatibility with different platforms

## [0.0.3](https://github.com/bazzline/php_component_command_collection/tree/0.0.3) - released at 2015-06-26

### Changed

* fixed issue with git->create()

## [0.0.2](https://github.com/bazzline/php_component_command_collection/tree/0.0.2) - released at 2015-05-26

### Changed

* fixed namespace issue with git

## [0.0.1](https://github.com/bazzline/php_component_command_collection/tree/0.0.1) - released at 2015-05-26

### Added

* initial release
