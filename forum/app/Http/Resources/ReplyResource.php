<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'body' => $this->body,
            'user' => new UserResource($this->user),
            'created_at' => $this->created_at->diffForHumans(),
            'own' => optional($request->user())->id === $this->user_id,
            'likes' => $this->getUserIdInLikes($this->likes)
        ];
    }



    protected function getUserIdInLikes($likes) {
          return  $likes->map(function($like){
                return $like->user_id;
          })->flatten();
    }
}
