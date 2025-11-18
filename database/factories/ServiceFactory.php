<?php
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
protected $model = Service::class;

public function definition()
{
return [
'name' => $this->faker->word(),
'label' => $this->faker->sentence(),
];
}
}
