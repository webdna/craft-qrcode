# QRCode plugin for Craft CMS 3.x

Generate a QR code

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1.  Open your terminal and go to your Craft project:

```
    cd /path/to/project
```

2.  Then tell Composer to load the plugin:

```
    composer require kuriousagency/qrcode
```

3.  In the Control Panel, go to Settings → Plugins and click the “Install” button for QRCode.

## QRCode Overview

This allows the generation of a QRCode via a fieldtype, variable or twig filter.

## QRCode Options

All instances of QRCode accept the following parameters:

1. **Data**: the data for the code.
2. **Size**: the size in pixels (default: 300)

## Using QRCode

Fieldtype:
In the fieldtype settings, you can use twig to dynamically get properties of the element that it is set on. eg on a user element:

```
	{"name":"{{ user.fullName }}"}
```

Twig variables:

```
    {{ craft.qrcode.generate(1234567890) }}

    {{ craft.qrcode.generate({"name":"John Smith"}, 100) }}
```

Twig Filters:

```
    {{ 1234567890|qrcode }}

    {{ {"name":"John Smith"}|qrcode(100) }}
```

## QRCode Roadmap

Some things to do, and ideas for potential features:

-   Release it

Brought to you by [Kurious Agency](https://kurious.agency)
