# QRCode plugin for Craft CMS 5.x

> Note: This is a fork of the original plugin for Craft 3.x. This fork is for Craft 5.x.
> To install, see the [instructions below](#craft-5-version-installation-from-fork) for the Craft 5 version installation from fork.


Generate a QR code

## Requirements

This plugin requires Craft CMS 5.0 or later.

## Installation

To install the plugin, follow these instructions.

1.  Open your terminal and go to your Craft project:

```
    cd /path/to/project
```

2.  Then tell Composer to load the plugin:

```
    composer require webdna/qrcode
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



Brought to you by [webdna](https://webdna.co.uk)


## Craft 5 version installation from fork


```
{
    "repositories": [
        ... other repos ...
        {
            "type": "vcs",
            "url": "https://github.com/johnfmorton/craft-qrcode"
        }
    ]
}
```

```
composer require webdna/qrcode:dev-craft-5
```
