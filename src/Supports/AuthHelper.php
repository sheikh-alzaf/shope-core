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

    public function vendorId(): ?string
    {
        return request()->header('x-vendor-id') ?? null;
    }

    public function user()
    {
        return (object) [
            'id' => $this->id(),
            'email' => $this->email(),
            'name' => $this->name(),
            'type' => $this->type(),
            'vendor_id' => $this->vendorId(),
        ];
    }
}