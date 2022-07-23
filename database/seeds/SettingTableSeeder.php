<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            array('id' => '1','home_video' => 'homeVideo/2022/04/625a5b1cdeb01_1650088732.mp4','admin_id' => '2','created_at' => '2022-04-16 05:52:03','updated_at' => '2022-05-16 16:20:02','story_first_step' => 'homeVideo/2022/05/628279a480c02_1652717988.mp4','story_second_step' => 'homeVideo/2022/05/628279ab74a53_1652717995.mp4','story_third_step' => 'homeVideo/2022/05/627ecb6216d2f_1652476770.mov','story_fourth_step' => 'homeVideo/2022/05/627ecb62179cc_1652476770.mov','story_fifth_step' => 'homeVideo/2022/05/627ecb656baf6_1652476773.mov'),
        ]);
    }
}
