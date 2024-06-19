<?php

namespace App\Traits;

trait Ownable
{
    public function scopeSetCreator() {
        return $this->update([
            'created_by' => auth()->id(),
            'updated_by' => auth()->id()
        ]);
    }

    public function scopeSetUpdater() {
        return $this->update([
            'updated_by' => auth()->id()
        ]);
    }
}
