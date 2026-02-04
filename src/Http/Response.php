<?php 

namespace App\Http;

class Response
{

    public function __construct(        
        private string $body = "",
        private int $statusCode = 200,
        private iterable $headers = []
        )
    {

    }
    
        /**
         * Get the value of body
         */ 
        public function getBody()
        {
                return $this->body;
        }

        /**
         * Set the value of body
         *
         * @return  self
         */ 
        public function setBody($body)
        {
                $this->body = $body;

                return $this;
        }

        /**
         * Get the value of statusCode
         */ 
        public function getStatusCode()
        {
                return $this->statusCode;
        }

        /**
         * Set the value of statusCode
         *
         * @return  self
         */ 
        public function setStatusCode($statusCode)
        {
                $this->statusCode = $statusCode;

                return $this;
        }
}