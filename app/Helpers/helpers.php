<?php
if (! function_exists('generate_licence')) {
    /**
     * Generate a URL to a named route.
     * @return string
     * @throws Exception
     */
    function generate_licence(): string
    {
        return random_int(1000,9999) . '-' . random_int(1000,9999) . '-' . random_int(1000,9999) . '-' . random_int(1000,9999) . '-' . random_int(1000,9999);
    }
}
