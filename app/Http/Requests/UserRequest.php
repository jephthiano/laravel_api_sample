<?php

namespace App\Http\Requests;

class UserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true; // Set to false if you want to restrict access
    }

    public function rules(): array
    {
        switch ($this->route()->getName()) {
            case 'users.update':
                return $this->updateRules();
            default:
                return [];
        }
    }

    private function updateRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:10|unique:users',
        ];
    }
}
