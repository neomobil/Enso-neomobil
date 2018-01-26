<?php

namespace LaravelEnso\FormBuilder\app\Classes;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\FormBuilder\app\Classes\Attributes\Actions;
use LaravelEnso\FormBuilder\app\Exceptions\TemplateException;

class Form
{
    private $model;
    private $template;

    public function __construct(string $template)
    {
        $this->setTemplate($template);
    }

    public function get()
    {
        if ($this->needsValidation()) {
            (new Validator($this->template))->run();
        }

        (new Builder($this->template, $this->model))->run();

        return $this->template;
    }

    public function create(Model $model = null)
    {
        $this->model = $model;

        $this->setMethod('post');

        return $this;
    }

    public function edit(Model $model)
    {
        $this->model = $model;

        $this->setMethod('patch');

        return $this;
    }

    public function actions(array $actions)
    {
        $this->template->actions = $actions;

        return $this;
    }

    public function routePrefix(string $prefix)
    {
        $this->template->routePrefix = $prefix;

        return $this;
    }

    public function title(string $title)
    {
        $this->template->title = $title;

        return $this;
    }

    public function icon(string $icon)
    {
        $this->template->icon = $icon;

        return $this;
    }

    public function route(string $action, string $route)
    {
        $this->template->routes[$action] = $route;

        return $this;
    }

    public function options(string $name, $value)
    {
        $this->getField($name)->meta->options = $value;

        return $this;
    }

    public function value(string $field, $value)
    {
        $this->getField($field)->value = $value;

        return $this;
    }

    public function meta(string $field, string $param, $value)
    {
        $this->getField($field)->meta->{$param} = $value;

        return $this;
    }

    public function autorize(bool $authorize)
    {
        $this->template->authorize = $authorize;
    }

    private function setTemplate(string $template)
    {
        $this->template = json_decode(\File::get($template));

        if (!is_object($this->template)) {
            throw new TemplateException(__('Template is not readable'));
        }

        return $this;
    }

    private function setMethod(string $method)
    {
        $this->template->method = $method;

        if (!isset($this->template->actions)) {
            $this->template->actions = $this->defaultActions();

            return;
        }

        return $this;
    }

    private function defaultActions()
    {
        return $this->template->method === 'post'
            ? ['store']
            : ['create', 'update', 'destroy'];
    }

    private function getField(string $name)
    {
        $field = collect($this->template->fields)->filter(function ($field) use ($name) {
            return $field->name === $name;
        })->first();

        if (!$field) {
            throw new TemplateException(__(
                'The :field field is missing from the JSON template',
                ['field' => $name]
            ));
        }

        return $field;
    }

    private function needsValidation()
    {
        return config('app.env') === 'local' || config('enso.datatable.validations') === 'always';
    }
}
