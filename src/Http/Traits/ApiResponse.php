<?php

namespace Humweb\Blog\Http\Traits;

/**
 * ApiResponse.php
 *
 * Author: ryan
 * Date:   1/31/16
 * Time:   2:14 PM
 */

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as IlluminateResponse;

trait ApiResponse
{
    /**
     * @var int
     */
    protected $responseCode = IlluminateResponse::HTTP_OK;


    /**
     * Set a response code to 200 and a response message
     *
     * @param string $message
     * @param array  $data
     *
     * @return IlluminateResponse
     */
    public function responseSuccess($data = [], $message = 'OK')
    {
        return $this->responseMessage(true, $message, $data);
    }


    /**
     * Set a response message
     *
     * @param $boolean
     * @param $message
     * @param $data
     *
     * @return IlluminateResponse
     */
    public function responseMessage($boolean, $message, $data = [])
    {
        return $this->response([
            'status'  => $boolean,
            'message' => $message,
            'data'    => $data
        ]);
    }
    //
    // SUCCESS RESPONSES, 200+
    //

    /**
     * Compose the response by setting the header and messages
     *
     * @param       $data
     * @param array $headers
     *
     * @return IlluminateResponse
     */
    public function response($data, $headers = [])
    {
        return new JsonResponse($data, $this->getResponseCode(), $headers);
    }


    /**
     * Get the response code
     *
     * @return int
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }


    /**
     * Set a response code e.g. 200 - success, 404 - post not found, 500 - internal server error, etc.
     *
     * @param $responseCode
     *
     * @return $this provides a fluent interface.
     */
    public function setResponseCode($responseCode = IlluminateResponse::HTTP_OK)
    {
        $this->responseCode = $responseCode;

        return $this;
    }
    //
    // CLIENT ERROR RESPONSES, 400+
    //

    /**
     * Set a response code to 201 and a response message
     *
     * @param string $message
     * @param array  $data
     *
     * @return IlluminateResponse
     */
    public function responseCreated($data = [], $message = 'Created')
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_CREATED)->responseMessage(true, $message, $data);
    }


    /**
     * Set a response code to 202 and a response message
     *
     * @param string $message
     * @param array  $data
     *
     * @return IlluminateResponse
     */
    public function responseAccepted($data = [], $message = 'Accepted')
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_ACCEPTED)->responseMessage(true, $message, $data);
    }


    /**
     * Set a response code to 400 and a response message
     *
     * @param string $message
     * @param array  $data
     *
     * @return IlluminateResponse
     */
    public function responseBadRequest($data = [], $message = 'Bad Request')
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_BAD_REQUEST)->responseMessage(false, $message, $data);
    }


    /**
     * Set a response code to 401 and a response message
     *
     * @param string $message
     * @param array  $data
     *
     * @return IlluminateResponse
     */
    public function responseUnauthorized($data = [], $message = 'Unauthorized')
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_UNAUTHORIZED)->responseMessage(false, $message, $data);
    }


    /**
     * Set a response code to 403 and a response message
     *
     * @param string $message
     * @param array  $data
     *
     * @return IlluminateResponse
     */
    public function responseForbidden($data = [], $message = 'Forbidden')
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_FORBIDDEN)->responseMessage(false, $message, $data);
    }
    //
    // SERVER ERROR RESPONSES, 500+
    //

    /**
     * Set a response code to 404 and a response message
     *
     * @param string $message
     * @param array  $data
     *
     * @return IlluminateResponse
     */
    public function responseNotFound($data = [], $message = 'Not Found')
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_NOT_FOUND)->responseMessage(false, $message, $data);
    }


    /**
     * Set a response code to 406 and a response message
     *
     * @param string $message
     * @param array  $data
     *
     * @return array
     */
    public function responseNotAcceptable($data = [], $message = 'Not Acceptable')
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)->responseMessage(false, $message, $data);
    }


    /**
     * Set a response code to 500 and a response message
     *
     * @param string $message
     * @param array  $data
     *
     * @return IlluminateResponse
     */
    public function responseInternalError($data = [], $message = 'Internal Error')
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->responseMessage(false, $message, $data);
    }


    /**
     * Set a response code to 501 and a response message
     *
     * @param string $message
     * @param array  $data
     *
     * @return array
     */
    public function responseNotImplemented($data = [], $message = 'Not Implemented')
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_NOT_IMPLEMENTED)->responseMessage(false, $message, $data);
    }
}