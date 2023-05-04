<?php

namespace Database\Seeders;

use App\Settings\LayoutSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $layoutSettings = app(LayoutSettings::class);

        $layoutSettings->homepage_faq_items = [
            [
                'question' => 'Can I use a nulled version of your software?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
            ],
            [
                'question' => 'If you won the lottery, what would you do?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
            ],
            [
                'question' => 'If Wikipedia were a book, how many pages would it be?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
            ],
            [
                'question' => 'If you were a software program, which one would you be?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
            ],
            [
                'question' => 'How might you instruct someone to make a balloon animal using only words?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
            ],
            [
                'question' => 'Would Mother Teresa have made a good software engineer?',
                'answer' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
            ],
        ];

        $layoutSettings->save();
    }
}
