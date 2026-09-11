# QRCode Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## Unreleased
### Fixed
- Fixed `Call to undefined method Endroid\QrCode\QrCode::create()` when `endroid/qr-code` 6.x is installed. The service now uses the `QrCode` constructor, which is identical in 5.x and 6.x, instead of the static `create()`/setter chain that 6.0 removed. ([#15](https://github.com/webdna/craft-qrcode/issues/15))

## 5.0.1 - 2026-09-08
### Updated
- Updated `endroid/qr-code` to allow v6 or v5

## 5.0.0 - 2024-04-08
### Updated
- Updated to Craft CMS 5.0 and above
- Version number aligned with Craft CMS version
- Icon added for Craft CMS 5.0 field type
- Updated `endroid/qr-code` to v5
- Reworked normalizeValue method to return string or JSON string
- Added inline documentation for field creation

## 2.1.0 - 2023-08-04
### Updated
- Updated endroid/qr-code to v4

## 2.0.1 - 2022-07-20

### Updated

- Update icon

## 2.0.0 - 2022-06-02

### Added

- Added Craft 4 support

## 1.0.6 - 2022-06-10

### Changed

- Change of ownership

## 1.0.5 - 2020-10-21

### Changed

- Removed character limit on content column

## 1.0.4 - 2020-10-12

### Fixed

- Incorrect function name changed.

## 1.0.3 - 2019-07-11

### Fixed

-   if the data is an array then it will json encode it.

## 1.0.2 - 2019-03-01

### Changed

-   no longer automatically encode to json when encoding data for QRCode.

## 1.0.1 - 2019-02-28

### Fixed

-   composer links

## 1.0.0 - 2019-02-25

### Added

-   Initial release
