<?php

namespace Shope\Core\Supports;

class AuthHelper
{
    public function id()
    {
        return request()->header('x-user-id');
    }

    public function email(): ?string
    {
        return request()->header('x-user-email');
    }

    public function name(): ?string
    {
        return request()->header('x-user-name');
    }

    public function type(): ?string
    {
        return request()->header('x-user-type');
    }

    public function shopId(): ?string
    {
        return request()->header('x-user-shop-id') ?? null;
    }

    public function user()
    {
        return (object) [
            'id' => $this->id(),
            'email' => $this->email(),
            'name' => $this->name(),
            'type' => $this->type(),
            'shop_id' => $this->shopId(),
        ];
    }
}