<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Vietnamese implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $value = trim($value);

        if (preg_match("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|ì|í|ị|ỉ|ĩ|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|ỳ|ý|ỵ|ỷ|ỹ|đ)/", $value)) {
            $fail(':attribute không được có dấu tiếng việt.');
        } elseif (preg_match("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|Ì|Í|Ị|Ỉ|Ĩ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|Ỳ|Ý|Ỵ|Ỷ|Ỹ|Đ)/", $value)) {
            $fail(':attribute không được có dấu tiếng việt.');
        }
    }
}
