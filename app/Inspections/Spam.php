<?php

namespace App\Inspections;


class Spam
{
    protected $inspections = [
        InvalidKeywords::class,
        KeyHeldDown::class
    ];

    public function detect($body)
    {
        foreach ($this->inspections as $inspections) {
            app($inspections)->detect($body);
        }

        return false;
    }
}
