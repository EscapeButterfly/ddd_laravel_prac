<?php

namespace App\Store\Client\Domain\Model\ValueObjects;

use App\Store\Client\Domain\Exception\NotValidAddressException;
use App\Store\Client\Domain\Model\Entities\Address;
use App\Store\Common\Domain\ValueObjectArray;

final class Addresses extends ValueObjectArray
{
    public readonly array $value;

    public function __construct(array $addresses)
    {
        parent::__construct($addresses);

        foreach ($addresses as $address) {
            if (!$address instanceof Address) {
                throw new NotValidAddressException;
            }
        }

        $this->value = $addresses;
    }

    public function jsonSerialize(): array
    {
        return $this->value;
    }
}
