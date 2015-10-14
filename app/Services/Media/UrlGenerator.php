<?php

namespace App\Services\Media;

use Spatie\MediaLibrary\UrlGenerator\BaseUrlGenerator;
use Spatie\MediaLibrary\UrlGenerator\UrlGenerator as UrlGeneratorContract;

class UrlGenerator extends BaseUrlGenerator implements UrlGeneratorContract
{
    public function getUrl()
    {
        return '123';
    }
}
