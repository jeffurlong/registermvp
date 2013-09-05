<?php
    /**
     * If the static property has already been set, returns it. Otherwise, parses
     * the HTTP_HOST to determine if there is a subdomain. If found, sets the
     * static property to the subdomain value. If there is no subdomain, sets the
     * static property to boolean false. Returns the static property.
     *
     * @param   int     The maximum number of segments of the hostname without a
     *                  subdomain. This will always be 2 except in cases of
     *                  international tlds such as .co.uk, which would be 3.
     * @return  string  The subdomain
     * @return  null    If there is no subdomain, returns null
     */
    function subdomain($max = 2)
    {
        if (isset($_SERVER['SERVER_NAME']))
        {
            $segments = explode('.', $_SERVER['SERVER_NAME']);

            return (count($segments) > $max and $segments[0] !== 'www') ? $segments[0] : null;
        }

        throw new \Exception('SERVER_NAME not set');
    }

    function getPageTemplateName()
    {

        if (isset($_SERVER['REQUEST_URI']))
        {
            $a = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

            return implode('_', $a);
        }

        throw new \Exception('REQUEST_URI not set');
    }
