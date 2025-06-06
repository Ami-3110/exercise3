<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 運動時間を0〜120分の範囲でランダム生成
        $minutes = $this->faker->numberBetween(0, 120);

        // 分をHH:MM:SS形式に変換 (秒は00固定)
        $exerciseTime = sprintf('%02d:%02d:00', floor($minutes / 60), $minutes % 60, 0);
        return [
            'user_id' => 1, // または適宜既存IDに変更
            'date' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1, 900, 700), // 例: 700kg〜900kg
            'calories' => $this->faker->numberBetween(1200, 3000),
            'exercise_time' => $exerciseTime,
            'exercise_content' => $this->faker->randomElement(['ランニング', '水泳', 'お散歩', '腹筋', 'バイバイの練習','餌探し','フリーダイビング','でんぐり返しの練習','投げキッスの練習',]),
        ];
    }
}
