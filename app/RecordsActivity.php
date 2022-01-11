<?php

namespace App;
use Illuminate\Support\Arr;

trait RecordsActivity{

    public $oldAttributes = [];
    /**
     * Boot the trait
     */
    public static function bootRecordsActivity(){
        static::updating(function ($model){
            $model->oldAttributes = $model->getOriginal();
        });
    }

    public function recordActivity($description){

        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id
        ]);

    }

    public function activity(){

        return $this->hasMany(Activity::class)->latest();

    }

    protected function activityChanges(){

        if($this->wasChanged()){

            // array_expect is deprected
            return [
                'before' => Arr::except(array_diff($this->oldAttributes, $this->getAttributes()), ['updated_at']),
                'after' => Arr::except($this->getChanges(), ['updated_at'])
            ];
        }


    }

}