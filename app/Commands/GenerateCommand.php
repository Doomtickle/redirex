<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class GenerateCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'generate
        {--I|input= : Path to the csv file used to generate the redirects}
        {--O|output=redirects.txt : Where the redirects.txt file will be stored}
        {--F|find=* : Pattern to search for}
        {--R|replace=* : Replace the pattern}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'CLI to generate 301 redirects for Wray Ward';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $input = $this->option('input');
        $output = $this->option('output');
        $rows = array_slice(array_map('str_getcsv', file($input)), 3);
        $goodRedirects = '';
        $find = array_map(function ($pattern) {
                return "%${pattern}%";
        }, $this->option('find'));
        $replace = array_map(function ($replacement) {
                return "${replacement}";
        }, $this->option('replace'));

        foreach ($rows as $row) {
            $redirect = trim($row[6]);
            if (strlen($redirect) > 12) {
                $parsed = preg_replace($find, $replace, $redirect);
                $exploded = explode(' ', $parsed);
                $exploded[1] .= '$';
                $fullString = implode(' ', $exploded);
                $goodRedirects .= $fullString . ' [R=301,QSA,L]' . PHP_EOL;
            }
        }

        file_put_contents($output, $goodRedirects);
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
