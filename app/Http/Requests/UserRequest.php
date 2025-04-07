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
            case 'auth.login':
                return $this->loginRules();

            case 'auth.register':
                return $this->registerRules();

            default:
                return [];
        }
    }

    private function loginRules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ];
    }

    private function registerRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:10|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
