<?php
namespace Shope\Core\Enums;

enum UserTypeEnum: string {
    case Admin  = "Admin";
    case Customer = "Customer";
    case Vendor = "Vendor";
}
