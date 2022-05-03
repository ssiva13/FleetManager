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
if (! function_exists('getStrAsArray')) {
	function getStrAsArray(string $str)
	{
		$str = strtolower($str);
		if (str_contains($str, ' ')) {
			$str_array = explode(' ', $str);
			$count_str = count($str_array);
			if ($count_str > 2) {
				$str_array = array_slice($str_array, 0, 2);
			}
			return $str_array;
		}
		return str_split($str);
	}
}
