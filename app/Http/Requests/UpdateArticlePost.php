<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticlePost extends FormRequest
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
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'keywords' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'published_at' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'subtitle.required' => '副标题不能为空',
            'subtitle.max:255' => '副标题不可多于255个字符',
            'keywords.required' => '关键词不能为空',
            'content.required' => '文章内容不能为空',
            'tags.required' => '文章类别不能为空',
            'published_at.required' => '发布时间不能为空',
            'published_at.date' => '时间格式不正确，请输入一个基于 PHP strtotime() 函数的有效日期'
        ];
    }
}
