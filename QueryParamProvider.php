<?php

/**
 * Pico QueryParamProvider
 *
 * A plugin for the Pico CMS which makes the query params available in
 * the twig templates.
 *
 * In Pico CMS the first parameter is the content url and gets stripped so it won't appear
 * in the array of query parameters.
 *
 * The query parameters are stored in an associative array. No-value parameters get the boolean
 * value TRUE.
 *
 * The parameters are accesible in the twig templates via queryParams.
 *
 * @author mightyplow
 * @link https://github.com/mightyplow/pico_QueryParamProvider
 */

class QueryParamProvider extends AbstractPicoPlugin {
    protected $enabled = true;

    public function onPageRendering(&$twig, &$twigVars) {
        $queryString = $_SERVER['QUERY_STRING'];
        $queryParams = explode('&', $queryString);

        // remove content url component
        if (!empty($this->getPico()->getRequestUrl())) {
            array_shift($queryParams);
        }

        $params = [];
        foreach ($queryParams as $param) {
            if (!empty($param)) {
                $parts = explode('=', $param);
                $numParts = count($parts);

                if ($numParts >= 1 && $numParts <= 2) {
                    if ($numParts === 1) {
                        $key = $parts[0];
                        $value = true;
                    } else if ($numParts === 2) {
                        $key = $parts[0];
                        $value = $parts[1];
                    }

                    $params[$key] = $value;
                }
            }
        }

        $twigVars['queryParams'] = $params;
    }
}
