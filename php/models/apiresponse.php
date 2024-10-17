<?php

class APIResponse implements JsonSerializable {
    private string $status;
    private string $message;
    private $data;

    public function __construct($data) {
        $this->status = "success";
        $this->message = "Ok";
        $this->data = $data;
    }

    public function error($message) {
        $this->status = "error";
        $this->message = $message;
        return $this;
    }

    public function set_status($status) {
        $this->status = $status;
        return $this;
    }

    public function set_message($message) {
        $this->message = $message;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "status" => $this->status,
            "message" => $this->message,
            "data" => $this->data
        ];
    }
}