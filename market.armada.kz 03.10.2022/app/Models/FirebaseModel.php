<?php
namespace App\Models;

use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseModel{
    public function phones(){
        $all_phones= [];
        $users= Firebase::auth()->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);

        foreach ($users as $user){
            array_push($all_phones, $user->phoneNumber);
        }

        return $all_phones;
    }
}
