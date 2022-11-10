<?php
namespace App\Http\Traits;

trait HasRole{
    public function hasRoles($roles){
        return count(array_intersect($roles,$this->roles->pluck('title')->toArray()));
    }
}
