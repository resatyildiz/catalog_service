<?php

namespace App\Traits;

trait HttpResponses
{
    /**
     * @description returns a success response
     *
     * @return json response
     *
     * @example = return $this->success($data, $message, $code);
     */
    protected function success($data, $message = "success", $code = 200)
    {
        return response()->json([
            'status' => "Request was successful",
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * @description - returns an error response
     *
     * @param $data - data to be returned
     * @param $message - message to be returned
     * @param $code - status code to be returned default 400
     *
     * @return json response
     *
     * @example $this->error($data, $message, $code);
     */
    protected function error($data, $message = "error", $code = 400)
    {
        return response()->json([
            'status' => "Error has occurred",
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
