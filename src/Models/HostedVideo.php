<?php

namespace Artificertech\LaravelHostedVideos\Models;

use Artificertech\LaravelHostedVideos\Sources\Source;
use Artificertech\LaravelRenderable\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;

class HostedVideo extends Model implements Renderable
{
    protected $table = 'hosted_videos';
    protected $fillable = ['source', 'video_id', 'custom_properties', 'order', 'collection_name'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'source' => Source::class,
        'custom_properties' => 'array'
    ];

    public function videoable()
    {
        return $this->morphTo();
    }

    /**
     * Get the view that represents the renderable object.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view($this->source->view());
    }

    /**
     * Defines the variable name that this renderable class
     * will have when used with the x-renderable blade component.
     *
     * @return string
     */
    public function renderableName(): string
    {
        return 'video';
    }


    //Functions to Interact with CustomProperties
    public function livewireCustomPropertyAttributes(string $customProperty, $property, $index): HtmlString
    {

        $value = $this->custom_properties[$customProperty] ?? '';
        return new HtmlString(implode(PHP_EOL, [
            'x-data=""',
            "name='$property.$index.custom_properties.$customProperty'",
            "value='$value'",
            "x-on:keyup.debounce=\"\$wire.updateHostedVideoCustomProperties($this->order,'$customProperty',document.getElementsByName('$property.$index.custom_properties.$customProperty')[0].value,'$property')\"",

        ]));
    }

    public function customPropertyErrorName(string $customProperty, $property, $index): string
    { //'newArray.{{ $index }}.custom_properties.caption'
        return "$property.$index.custom_properties.$customProperty";
    }


    public function setCustomProperty(string $name, string $value)
    {
        $customProperties = $this->custom_properties;
        // if (is_object($customProperties))
        //     $customProperties->$name = $value;
        // else
        $customProperties[$name] = $value;
        $this->custom_properties =  $customProperties;
        // $this->custom_properties[$name] = json_encode($customProperties);
        return $this;
    }

    public function forgetCustomProperty(string $name)
    {
        $customProperties = $this->custom_properties;
        // if (is_object($customProperties))
        //     unset($customProperties->$name);
        // else
        unset($customProperties[$name]);
        $this->custom_properties = $customProperties;
        return $this;
    }

    public function hasCustomProperty(string $name)
    {
        $customProperties = $this->custom_properties;
        // if (is_object($customProperties))
        return (array_key_exists($name, $customProperties));
    }

    public function getCustomProperty(string $name)
    {
        // $customProperties = json_decode($this->custom_properties);
        // if (is_object($customProperties))
        return $this->custom_properties[$name] ?? null;
    }

    public function getCustomProperties()
    {
        return $this->custom_properties;
    }
}
