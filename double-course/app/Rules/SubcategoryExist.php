<?php

namespace App\Rules;

use App\Models\Subcategory;
use Illuminate\Contracts\Validation\Rule;

class SubcategoryExist implements Rule
{
    public $category_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($category_id = 0)
    {
        $this->category_id = $category_id;
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
        if ($this->category_id == 0){
            return Subcategory::find($value);
        }

        return Subcategory::where('category_id',$this->category_id)->where('id',$value)->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->category_id == 1){
            return 'Не верный id медитации';
        } else if ($this->category_id == 2){
            return 'Не верный id аффирмации';
        } else {
            return 'Не верный id';
        }
    }
}
