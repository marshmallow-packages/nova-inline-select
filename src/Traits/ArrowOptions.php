<?php

namespace Marshmallow\NovaInlineSelect\Traits;

trait ArrowOptions
{
    public function showArrows(): self
    {
        return $this->withMeta([
            'showArrowsOnIndex' => true,
            'showArrowsOnDetail' => true,
        ]);
    }

    public function hideArrows(): self
    {
        return $this->withMeta([
            'showArrowsOnIndex' => false,
            'showArrowsOnDetail' => false,
        ]);
    }

    public function showArrowsOnIndex(): self
    {
        return $this->withMeta([
            'showArrowsOnIndex' => true,
        ]);
    }

    public function hideArrowsOnIndex(): self
    {
        return $this->withMeta([
            'showArrowsOnIndex' => false,
        ]);
    }

    public function showArrowsOnDetail(): self
    {
        return $this->withMeta([
            'showArrowsOnDetail' => true,
        ]);
    }

    public function hideArrowsOnDetail(): self
    {
        return $this->withMeta([
            'showArrowsOnDetail' => false,
        ]);
    }
}
