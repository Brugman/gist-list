# Gist List

> Gist List let's you store your Gist metadata locally, and fuzzy search the file names in a DataTable UI.
> You can also host this on a private location to let people browse your secret Gists, without giving them access to your account.

![screenshot](/screenshot.png)

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Required configuration](#required-configuration)
- [Tips](#tips)
- [FAQ](#faq)
- [Contributing](#contributing)
- [Author](#author)

## Requirements

- Apache (any webserver)
- PHP

## Installation

1. Map `public_html` to a (sub)domain.

## Required configuration

- Copy `app/config-example.php` to `app/config.php`.
- Configure `app/config.php` with:
    + Your GitHub username.
    + A [GitHub personal access token](https://github.com/settings/tokens).
    + A random string.
- Visit the (sub)domain.
- Click the update button.

## Tips

### Firefox keyword search

By appending `/?q=KEYWORD` you can leverage Firefox's keyword feature on bookmarks to instantly search your Gist List from the url bar. For example: `gist flexbox`.

## FAQ

### Why not use the GitHub website?

DataTables provides fuzzy searching and subjectively a much nicer UI than the GitHub Gist web search. To search private Gists you also need to be signed in the to Gist owner's account. If you have a single Gist library for your entire team, that will require a lot of account switching.

### Why not use the Sublime Text plugin?

While managing Gists from within your editor is awesome, the [Sublime Text Gist plugin](https://github.com/condemil/Gist) is limited to a single API call, which gives you [a maximum of 100 Gists](https://github.com/condemil/Gist#options). Gist List paginates the API call and runs it recursively until it has retrieved all your Gists.

### Why not use the *other editor* plugin?

No idea. I personally love Sublime Text too much, but you do you.

### Why was Gist List made?

Gist List was made when GistBox went freemium and rebranded to Cacher. The free plan was insufficient, but the paid plan overkill.

### Why are Gist file names used instead of descriptions?

GistBox used file name search. So our agency's developers built up a Gist library with descriptive file names. If you want a description-powered Gist List feel free to request this in an issue, or fork the code.

## Contributing

Found a bug? Anything you would like to ask, add or change? Please open an issue so we can talk about it.

Pull requests are welcome. Please try to match the current code formatting.

### Development requirements

- npm

### Development installation

1. Perform the regular installation & configuration.
1. `npm i`

### Build tools

Command | Minification | Sourcemaps
:--- |:--- |:---
`gulp` | :heavy_minus_sign: | :heavy_check_mark:
`gulp --env=prod` | :heavy_check_mark: | :heavy_minus_sign:

## Author

[Tim Brugman](https://github.com/Brugman)