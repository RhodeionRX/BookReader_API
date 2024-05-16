<?php

namespace App\Traits;

trait Ownable
{
    public function scopeSetCreator() {
        return $this->update([
            'created_by', auth()->user()->id,
            'updated_by', auth()->user()->id
        ]);
    }

    public function scopeSetUpdater() {
        return $this->update([
            'updated_by', auth()->user()->id
        ]);
    }
}
