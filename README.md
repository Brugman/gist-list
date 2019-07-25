# Gist List

Gist List let's you store your Gist metadata locally, and fuzzy search the file names in a DataTable UI.

You can host this on a protected, private or LAN location to let people browse your secret Gists, without giving them your account.

![screenshot](https://raw.githubusercontent.com/Brugman/gist-list/develop/screenshot.png)

## Firefox keyword search

By appending `/?q=KEYWORD` you can leverage Firefox's keyword feature on bookmarks to instantly search your Gist List from the url bar. For example: `gist flexbox`.

## Why not use the GitHub website?

DataTables provides fuzzy searching and subjectively a much nicer UI than the GitHub Gist web search. To search private Gists you also need to be signed in the to Gist owner's account. If you have a single Gist library for your entire team, that will require a lot of account switching.

## Why not use the Sublime Text plugin?

While managing Gists from within your editor is awesome, the [Sublime Text Gist plugin](https://github.com/condemil/Gist) is limited to a single API call, which gives you [a maximum of 100 Gists](https://github.com/condemil/Gist#options). Gist List paginates the API call and runs it recursively until it has retrieved all your Gists.

## Why not use the *other editor* plugin?

No idea. I personally love Sublime Text too much, but you do you.

## Why was Gist List made?

Gist List was made when GistBox went freemium and rebranded to Cacher. The free plan was insufficient for our team, and the paid plan too expensive for our basic needs.

## Why are Gist file names used instead of descriptions?

GistBox used file name search. So our dev team built up a Gist library with descriptive file names. If you want a description-powered Gist List feel free to request this in an issue, or fork the code.