<?php


namespace Modules\Api\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    protected $statusCode;

    public function success($message, $data = []) {
        $response = Response::HTTP_OK;

        return $this->setStatusCode($response)->respond(['message' => $message, 'data' => $data]);
    }

    public function failed($message, $data = []) {
        $response = Response::HTTP_BAD_REQUEST;

        return $this->setStatusCode($response)->respond(['message' => $message, 'data' => $data]);
    }

    public function error($message, $data = []) {
        $response = Response::HTTP_INTERNAL_SERVER_ERROR;

        return $this->setStatusCode($response)->respond(['message' => $message, 'data' => $data]);
    }


    public function unauthorized($message) {
        $response = Response::HTTP_UNAUTHORIZED;

        return $this->setStatusCode($response)->respond(['message' => $message]);
    }

    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}