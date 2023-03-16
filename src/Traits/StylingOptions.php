<?php

namespace Marshmallow\NovaInlineSelect\Traits;

trait StylingOptions
{
    public function maxWidthOnIndex(string $maxWidth): self
    {
        return $this->withMeta([
            'maxWidthOnIndex' => $maxWidth,
        ]);
    }

    public function maxWidthOnDetail(string $maxWidth): self
    {
        return $this->withMeta([
            'maxWidthOnDetail' => $maxWidth,
        ]);
    }
}
