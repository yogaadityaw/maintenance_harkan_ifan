<?php

namespace App\Helper;

class ApiResponseHelper
{
    /**
     * Extract the 'data' portion of an API response.
     *
     * @param array $response The JSON-decoded response from the API.
     * @return array The extracted data.
     */
    public static function extractData(array $response)
    {
        // Check if 'data' exists in the response and return it
        if (isset($response['data'])) {
            return $response['data'];
        }

        // Optionally, handle cases where 'data' is not present
        // This could throw an exception, return an empty array, or handle it in another way
        throw new \Exception("Data not found in the response.");
    }
}
