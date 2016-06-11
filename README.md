# QueryParamProvider

A plugin for the Pico CMS which makes the query params available in
the twig templates.

In Pico CMS the first parameter is the content url and gets stripped so it won't appear
in the array of query parameters.

The query parameters are stored in an associative array. No-value parameters get the boolean
value TRUE.

The parameters are accesible in the twig templates via queryParams.

## Installation

Just copy the php file into the plugins folder. The plugin is configured to be enabled by defaut.
