<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Kreait\Laravel\Firebase\Facades\Firebase;
use App\Http\Services\user\UserService;

class VerifyPhone implements Rule
{
    protected $userService;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $users= Firebase::auth()->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);

        foreach ($users as $user){
            //для безопасности проверяем все возможные строки
            if ($user->uid == $value['uid'] && $user->phoneNumber == UserService::getFirstPhone($value['phone']) && $user->metadata->createdAt->getTimestamp() == substr($value['created_at'], 0, -3)){
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Вы не подтвердили свой номер';
    }
}
