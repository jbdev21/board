<?php

use App\Console\Commands\CollectJobOpeningFromExternal;
use Illuminate\Support\Facades\Schedule;

Schedule::command(CollectJobOpeningFromExternal::class)->everyThreeHours();
