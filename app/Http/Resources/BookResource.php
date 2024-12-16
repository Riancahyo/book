<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     public $status;
     public $pesan;
     public $resource;


     public function __construct($status,$pesan,$resource)
    {
        parent::__construct($resource);
        $this ->status=$status;
        $this ->pesan=$pesan;
    }
    public function toArray(Request $request): array
    {
        return [
            "succes"=>$this->status,
            "pesan"=>$this->pesan,
            "data"=>$this->resource
        ];
    }
}