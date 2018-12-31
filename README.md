# Gist List

The Gist List let's you locally store your Gist metadata, and fuzzy search the file names in a DataTable.

With `/?q=KEYWORD` you can leverage your browsers' keyword function to instantly search the Gist List. I.e. `gist flexbox`.

You can host this on a protected, private or LAN location to let people access your secret Gists, without giving them your password.

## Why not use the Sublime Text Gist plugin?

The Sublime Text Gist plugin is limited to a single API call, which gives you a maximum of 100 Gists. Gist List paginates the API call and runs it recursively until it has retreived all your Gists.

## Why not use the Github website?

The DataTables display format and fuzzy search makes it a more flexible list than the Github Gist web search.