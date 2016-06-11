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
 * @link
 */

class QueryParamProvider extends AbstractPicoPlugin {
    protected $enabled = true;

    public function onPageRendering (&$twig, &$twigVars) {
        $queryString = $_SERVER['QUERY_STRING'];
        $queryParams = explode('&', $queryString);

        // remove content url component
        if (!empty($this->getPico()->getRequestUrl())) {
            array_shift($queryParams);
        }

        $params = [];
        foreach ($queryParams as $param) {
            if (!empty($param)) {
                list($key, $value) = explode('=', $param);
                $params[$key] = isset($value) ? $value : true;
            }
        }

        $twigVars['queryParams'] = $params;
    }
}
