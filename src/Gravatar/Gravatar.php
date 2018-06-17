<?php

namespace Vibe\Gravatar;

/**
 * Gravatar class to get gravatar from user emails.
 */
class Gravatar
{
    /**
    * get url
    * @param string $email - email to be used for gravatar
    * @param int $size - optional size of image
    * @return string $url - gravatar url
    */
    public function url($email, $size = 80)
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$size";
        return $url;
    }
}
