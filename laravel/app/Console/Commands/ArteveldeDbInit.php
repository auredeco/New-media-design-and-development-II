<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ArteveldeDbInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //read variables from .env
        $dbName = getenv('DB_DATABASE');
        $dbUsername = getenv('DB_USERNAME');
        $dbPassword = getenv('DB_PASSWORD');

        //add database user with all privileges on database
        $sql = "CREATE DATABASE IF NOT EXISTS ${dbName} CHARACTER SET utf8 COLLATE utf8_unicode_ci";
        $command = sprintf('MYSQL_PWD="%s" mysql --user="%s" --execute="%s"',$dbUsername, $dbPassword, $sql);
        exec($command);

        $this->comment("Database `${dbName}` Initialized");
    }
}
