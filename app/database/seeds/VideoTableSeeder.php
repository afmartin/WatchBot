<?php

class VideoTableSeeder extends Seeder {

    public function run() {
        $faker = Faker\Factory::create();

        $videos = array ("V2lL30qF3Gw",
                         "6ocl2noqN-c",
                         "qwyZ0ji1GRU",
                         "A1EESKnq9Js",
                         "dQw4w9WgXcQ",
                         "zNjyJfIVB6E",
                         "BUREX8aFbMs",
                         "hBgOaJkpj3U",
                         "wz3BuYYhnn0",
                         "iB1TmdcylmE");


        for ($i = 0; $i < 10; $i++) {
            $video = Video::create(array(
                "description" => $faker->text(),
                "title" => $faker->sentence($nbWordsi = 5),
                "views" => $faker->numberBetween(0,1500),
                "user_id" => $faker->numberBetween(1,10),
                "video" => $videos[$i]
            ));
        }
    }
}