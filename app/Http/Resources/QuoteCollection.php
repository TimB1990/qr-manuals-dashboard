<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuoteCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'items' => $this->collection,
            'count_status' => [
                'pending' => $this->where('status','pending')->count(),
                'accepted' => $this->where('status','accepted')->count(),
                'processed' => $this->where('status','processed')->count(),
                'approved' => $this->where('status','approved')->count(),
                'denied' => $this->where('status','denied')->count(),
                'review' => $this->where('status','review')->count(),
            ],
            'count_all' => $this->all()->count()
        ];
    }
}
