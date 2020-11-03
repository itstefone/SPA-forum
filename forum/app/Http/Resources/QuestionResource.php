<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
                'id' => $this->id,
                'title' => $this->title,
                'slug' => $this->slug,
                'body'=> $this->body,
                'user' => new UserResource($this->user),
                'own' => optional(request()->user())->id === $this->user_id,
                'category' => new CategoryResource($this->category),
                'created_at' => $this->created_at->diffForHumans(),
                'replies' => ReplyResource::collection($this->replies)
        ];
    }
}
