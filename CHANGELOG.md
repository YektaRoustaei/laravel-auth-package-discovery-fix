# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-01-17

### Added
- Initial release
- Fix for "Auth driver not defined" error during package discovery
- Support for Laravel 10.x, 11.x, and 12.x
- Automatic fix with no configuration required
- Comprehensive test suite
- MIT license

### Fixed
- Resolves `Auth driver ['my-driver'] for guard [api] is not defined` error
- Prevents composer install/update failures with custom auth drivers
- Eliminates timing issues during Laravel package discovery process
