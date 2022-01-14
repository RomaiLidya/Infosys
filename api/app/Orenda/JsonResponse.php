<?php

namespace App\Orenda;

use Illuminate\Validation\ValidationException;

class JsonResponse
{
    private $data = [];
    private $error = false;
    private $status = 200;
    private $message = null;
    private $validator = null;
    private $meta = [];
    private $traces = [];

    /* Set data for JSON
    * @param Array
    */
    public function setData($data)
    {
        $this->data = $data;
    }

    public function setMeta($data)
    {
        $this->meta = $data;
    }

    /* Set if response is error
    * @param boolean
    */
    public function setError($error)
    {
        $this->error = $error;
    }

    /* Set validator error. Would automatically produce error in JSON
    * @param Illuminate\Validation\ValidationException
    */
    public function setValidationException(ValidationException $e)
    {
        $this->setError(true);
        $this->validator = $e->validator;
    }

    /* Set error message. When you have set validator exception.
    * This method is optional. It would get first validator error and place
    * to message. But if you set this while call setValidationException() then
    * this message would be used for 'message' index
    * @param string
    */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /* Set status
    * @param integer
    */
    public function setStatus($statusNo)
    {
        $this->status = $statusNo;
    }

    public function setTraces($traces)
    {
        $this->traces = $traces;
    }

    public function isError()
    {
        return $this->error;
    }

    /* Generate JSON response
    */
    public function getResponse()
    {
        $errors = [];
        $message = $this->message;

        // Check if validator is not empty
        if(!empty($this->validator)) {
            $errors = $this->validator->errors()->all();
        }

        if(empty($message) && !empty($errors))
            $message = $errors[0];
        elseif(!empty($this->message))
            $errors[] = $this->message;

        // JSON reponse
        $resp = [
            'data' => $this->data,
            '_meta' => $this->meta,
            'is_error' => $this->error,
            'errors' => $errors,
            'status' => $this->status,
            'message' => $message,
            'trace' => $this->traces
        ];

        return response()->json($resp, $this->status);
    }

    public static function getPaginatorConfig(\Illuminate\Pagination\LengthAwarePaginator $paginator) {
        return [
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'per_page' => (int) $paginator->perPage()
        ];
    }

}
