<?php

namespace App\Console\Commands;

use App\Enums\PositionStatusEnum;
use App\Jobs\InsertPositionFromExternalJob;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CollectJobOpeningFromExternal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:collect-job-opening-from-external';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get(config("services.external_source_endpoint")); // adjust path as needed
        if ($response->successful()) {
            $xmlString = $response->body();
        }
        $xml = simplexml_load_string($xmlString);

        foreach ($xml->position as $item) {
            // indexes should match positions table columns
            $position = [
                'title' => (string) $item->name,
                'external_id' => (int) $item->id,
                'company' => (string) $item->subcompany,
                'office' => (string) $item->office,
                'is_remote' => (bool) stripos($item->office, 'remote') !== false,
                'employment_type' => (string) $item->employmentType,
                'schedule' => (string) $item->schedule,
                'seniority' => (string) $item->seniority,
                'years_of_experience' => (string) $item->yearsOfExperience ?? null,
                'keywords' => (string) $item->keywords,
                'salary_min' => isset($item->salaryInformation->min) ? (float) $item->salaryInformation->min : null,
                'salary_max' => isset($item->salaryInformation->max) ? (float) $item->salaryInformation->max : null,
                'salary_currency_code' => isset($item->salaryInformation->currencyCode)  ? (string) $item->salaryInformation?->currencyCode : null,
                'salary_type' => isset($item->salaryInformation->type) ?  (string) $item->salaryInformation?->type : null,
                'external_created_at' => Carbon::parse($item->createdAt),
                'description' => collect($item->jobDescriptions->jobDescription)->map(function ($desc){
                    $title = (string) $desc->name;
                    $content = (string) $desc->value;
                    return "<h1>{$title}</h1><p>{$content}</p>";
                })->implode(""),
            ];

            InsertPositionFromExternalJob::dispatch($position);         
        }

    }
}
