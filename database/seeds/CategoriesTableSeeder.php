<?php

use Illuminate\Database\Seeder;
use App\categories;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
		$name = ['Кошки', 'Собаки', 'Рыбы', 'Птицы', 'Грызуны', 'Земноводные', 'Экзотические', 'Услуги', 'Аксессуары'];
		$img = [
			'/images/cat.svg',
			'/images/dog.svg',
			'/images/fish.svg',
			'/images/bird.svg',
			'/images/hamster.svg',
			'/images/turtle.svg',
			'/images/snake.svg',
			'/images/services.svg',
			'/images/collar.svg'
		];
		
    	for ($i = 0; $i < count($name); $i++){
			categories::insert([
				'name' => $name[$i],
				'img' => $img[$i],
			]);
		}
    
    }
}
