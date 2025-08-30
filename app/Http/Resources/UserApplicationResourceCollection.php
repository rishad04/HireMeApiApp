<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserApplicationResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    protected $params;
    public function __construct($collection, $params = '')
    {
        parent::__construct($collection);
        $this->params = $params;
    }


    public function toArray($request)
    {
        return $this->collection->map(function ($data) {
            if ($this->collection->isEmpty()) {
                return [];
            }

            return [

                'id' => $data->id,
                'status' => $data->status,
                'applied_at' => $data->created_at->format('F j, Y'),
                'payment_status' => $data->payment_status,
                'job' => [
                    'title' => $data->job->title,
                    'location' => $data->job->location,
                    'company' => $data->job->company->name ?? 'N/A',
                ]

            ];
        });
    }
    public function with($request)
    {
        if ($this->collection->isEmpty()) {
            return [
                'success' => false,
                'result' => false,
                'status' => 404
            ];
        }
        return [
            'success' => true,
            'result' => true,
            'status' => 200
        ];
    }
}
