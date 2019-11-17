<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticlesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>['required'], // '필드'=>'검사조건'
            'content'=>['required', 'min:10'], //적어도 10개 글자
        ];
    }
    public function attributes(){
        return [ 'title'=>'제목', 'content'=>'내용'];
    }
    public function message(){
        return [
            'required'=>':attribue은/는 필수 입력 항목임',
            'min'=>":attribue은/는은 최소 :min 글자 이상이여야 함",
        ];
    }
}
