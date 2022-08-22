<?php

namespace App\Command;

class Parser
{
    private array $optionValues;

    public function __construct()
    {
        $longOptions = [];
        foreach(Option::cases() as $directive) {
            $longOptions[] = $directive->name . "::";
        }
        $this->optionValues = getopt('', $longOptions);
    }

    public function getOption(Option $directive)
    {
        return $this->optionValues[$directive->name] ?? null;
    }
}