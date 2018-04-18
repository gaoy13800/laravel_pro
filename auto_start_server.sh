#!/bin/bash
#created by don_gao
#定时任务 cron
* * * * * php /path/to/artisan schedule:run 1>> /dev/null 2>&1