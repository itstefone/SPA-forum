<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Question;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->text(rand(50,100)),
            'user_id' => function() {
                return User::inRandomOrder()->first()->id;
            },
            'question_id' => function() {
                return Question::inRandomOrder()->first()->id;
            },
        ];
    }



    public function configure()
    {
        return $this->afterCreating(function (Reply $reply) {
                $reply->likes()->save(Like::factory()->make());

        });
    }
}
