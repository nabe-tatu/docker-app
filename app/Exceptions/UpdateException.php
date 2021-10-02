<?php

namespace App\Exceptions;

use App\Http\Requests\Request;
use Exception;

class UpdateException extends Exception
{
    public $request;
    public $message;
    public $class;

    public function __construct(Request $request, array $message, String $class)
    {
        parent::__construct();

        $this->request = $request;
        $this->message = implode(',', $message);
    }

    public function report()
    {
        logger("error occurred update on " . $this->class);
        logger("request:" . $this->request->all());
        logger("error:" . $this->getMessage());
        logger("message:" . $this->message);
    }

    public function render()
    {
        return response()->json([
            "error:" . $this->getMessage(),
            "message:" . $this->message
        ],400);
    }
}
