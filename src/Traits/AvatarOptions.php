<?php

namespace Marshmallow\NovaInlineSelect\Traits;

trait AvatarOptions
{
    public function avatarImages(array|callable $images): self
    {
        $images = is_callable($images) ? $images() : collect($images)->map(function ($image_path) {
            return '<img src="' . $image_path . '" class="mm-h-5 mm-w-5 mm-flex-shrink-0 mm-rounded-full"/>';
        })->toArray();
        return $this->withMeta([
            'avatarImages' => $images,
        ]);
    }

    public function noAvatarImage(string $image): self
    {
        return $this->withMeta([
            'noAvatarImage' => $image,
        ]);
    }

    public function avatarHtml(array|callable $images)
    {
        $images = is_callable($images) ? $images() : $images;
        return $this->withMeta([
            'avatarImages' => $images,
        ]);
    }
}
