<?php

namespace Marshmallow\NovaInlineSelect\Traits;

trait LabelOptions
{
    public function showLabel(): self
    {
        return $this->withMeta([
            'showLabelOnIndex' => true,
            'showLabelOnDetail' => true,
        ]);
    }

    public function hideLabel(): self
    {
        return $this->withMeta([
            'showLabelOnIndex' => false,
            'showLabelOnDetail' => false,
        ]);
    }

    public function showLabelOnIndex(): self
    {
        return $this->withMeta([
            'showLabelOnIndex' => true,
        ]);
    }

    public function hideLabelOnIndex(): self
    {
        return $this->withMeta([
            'showLabelOnIndex' => false,
        ]);
    }

    public function showLabelOnDetail(): self
    {
        return $this->withMeta([
            'showLabelOnDetail' => true,
        ]);
    }

    public function hideLabelOnDetail(): self
    {
        return $this->withMeta([
            'showLabelOnDetail' => false,
        ]);
    }
}
