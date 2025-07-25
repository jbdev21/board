<?php

namespace App\Jobs;

use App\Enums\PositionStatusEnum;
use App\Models\Position;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class InsertPositionFromExternalJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $positionArray)
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // checking if exists 
        $exists = Position::where('external_id', $this->positionArray['external_id'])
                            ->exists();
        if($exists){
            $beenUpdatedInSource = $exists->external_created_at->eq($this->positionArray['external_created_at']);
            if($beenUpdatedInSource){
                $exists->update($this->positionArray);
            }
            return;
        }

        $this->positionArray['status'] = PositionStatusEnum::PUBLISH;
        Position::create($this->positionArray);
    }
}
