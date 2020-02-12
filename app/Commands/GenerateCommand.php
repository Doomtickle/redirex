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
        {--O|output=redirects.txt : Where the redirects.txt file will be stored}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'CLI to generate 301 redirect for Wray Ward';

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
        $counter = 0;
        $pattern = '';
        $replacement = '';

        if ($this->confirm('Would you like to see a preview of your file?', true)) {
            $this->line($rows[0][6]);
            if ($this->confirm('Would you like to replace anything?')) {
                $pattern = $this->ask('What do you want to replace?');
                $replacement = $this->ask('What do you want to replace it with?');
            }
        }
        foreach ($rows as $row) {
            $redirect = trim($row[6]);
            if (strlen($redirect) > 12) {
                $parsed = preg_replace("/${pattern}/", $replacement, $redirect);
                $goodRedirects .= $parsed . PHP_EOL;
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
