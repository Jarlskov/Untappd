<?php

declare(strict_types=1);

namespace Jarlskov\Untappd\Models;

class Contact
{
    private string $facebook;
    private string $twitter;
    private string $url;

    public static function fromUntappdResponse(\stdClass $response): self
    {
        $contact = new Self();
        $contact->facebook = $response->facebook;
        $contact->twitter = $response->twitter;
        $contact->url = $response->url;

        return $contact;
    }
}
