<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;

class EmailRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($param = null)
    {
        //
        $this->type = $param;
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
        if(isset($this->type) && $this->type != null){
            return !User::where(["email" => $value, "status" => 1])->where("id", "!=", Auth::id())->exists();
        }else{
            return !User::where(["email" => $value, "status" => 1])->exists();
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'the :attribute already exists';
    }
}
