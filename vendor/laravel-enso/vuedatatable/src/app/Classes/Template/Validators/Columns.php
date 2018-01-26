<?php

namespace LaravelEnso\VueDatatable\app\Classes\Template\Validators;

use LaravelEnso\VueDatatable\app\Exceptions\TemplateException;
use LaravelEnso\VueDatatable\app\Classes\Attributes\Column as Attributes;

class Columns
{
    private $columns;

    public function __construct($template)
    {
        $this->columns = $template->columns;
    }

    public function validate()
    {
        $this->checkFormat();

        collect($this->columns)->each(function ($column) {
            $this->checkMandatoryAttributes($column)
                ->checkOptionalAttributes($column)
                ->checkMeta($column)
                ->checkEnum($column);
        });
    }

    private function checkFormat()
    {
        if (!is_array($this->columns) || empty($this->columns)
            || collect($this->columns)->first(function ($column) {
                return !is_object($column);
            }) !== null
        ) {
            throw new TemplateException(__(
                'The columns attribute must be an array of objects with at least one element'
            ));
        }
    }

    private function checkMandatoryAttributes($column)
    {
        $diff = collect(Attributes::Mandatory)
            ->diff(collect($column)->keys());

        if ($diff->isNotEmpty()) {
            throw new TemplateException(__(
                'Mandatory column attribute(s) missing: ":attr"',
                ['attr' => $diff->implode('", "')]
            ));
        }

        return $this;
    }

    private function checkOptionalAttributes($column)
    {
        $attributes = collect(Attributes::Mandatory)
            ->merge(Attributes::Optional);

        $diff = collect($column)
            ->keys()
            ->diff($attributes);

        if ($diff->isNotEmpty()) {
            throw new TemplateException(__(
                'Unknown Column Attribute(s) Found: ":attr"',
                ['attr' => $diff->implode('", "')]
            ));
        }

        return $this;
    }

    private function checkMeta($column)
    {
        if (property_exists($column, 'meta')) {
            Meta::validate($column->meta);
        }

        return $this;
    }

    private function checkEnum($column)
    {
        if (property_exists($column, 'enum')) {
            if (!class_exists($column->enum)) {
                throw new TemplateException(__(
                    'Provided enum does not exist: ":enum"',
                    ['enum' => $column->enum]
                ));
            }
        }

        return $this;
    }
}
