<?php
namespace App\Config;

abstract class Config{

    const LOG_PATH = [
        'command_path' => 'logs/logRecord/cmdLog/',
        'event_path' => 'logs/logRecord/eventLog/',
        'base_path' => 'logs/logRecord/baseLog/'
    ];

    const API_USER = 'admin';

    const API_PW = 'gaoq1w2';

    const BARS = [
        'aBcDeF$#@!',
        'AbCdEf!@#$',
        'Q1w2E3*&^',
        '^&*3e2W1q'
    ];

    const Add = 'add';
    const Edit = 'update';
    const Delete = 'delete';

    const XZD_URL = "http://dev.dcsf.hebeiwanteng.com/api/";

}