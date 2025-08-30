<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobCollection extends ResourceCollection
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

            $has_submitted = null;

            if (isset($this->params['user']) && $this->params['user'] != '') {
                $user_application = $data->userHasSubmitted($this->params['user']->id)->first();
                if ($user_application != '') {
                    $has_submitted = [
                        'user_application_id' => $user_application->id,
                        'job_id' => $user_application->job_id,
                    ];
                }
            }


            return [

                'id' => $data->id,
                'title' => $data->title,
                'type' => $data->type,
                'location' => $data->location,
                'company' => $data->company?->name,
                'description' => $data->description,
                'short_description' => $data->short_description,
                'has_submitted' => $has_submitted,

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
