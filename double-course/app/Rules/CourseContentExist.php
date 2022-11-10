<?php

namespace App\Rules;

use App\Models\CourseContent;
use Illuminate\Contracts\Validation\Rule;

class CourseContentExist implements Rule
{
    public $course_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($course_id = 0)
    {
        $this->course_id = $course_id;
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
        if ($this->course_id == 0){
            return CourseContent::find($value);
        }

        return CourseContent::where('course_id',$this->course_id)->where('id',$value)->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->course_id == 1){
            return 'Не верный id Обучение и практика';
        } else if ($this->course_id == 2){
            return 'Не верный id Мини-курсы';
        }
        else if ($this->course_id == 3){
            return 'Не верный id Вебинары';
        } else {
            return 'Не верный id';
        }
    }
}
