<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render(\Illuminate\Http\Request $request): \Illuminate\Http\Response
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], $this->getCode());
    }

}
