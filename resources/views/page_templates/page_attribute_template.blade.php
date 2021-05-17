@if($pageAttributeTemplate->repeatable === true)
    {!! '@@foreach(' . $base . '->' . $pageAttributeTemplate->slug . ' as $' . \Illuminate\Support\Str::singular($pageAttributeTemplate->slug) . ')'  !!}
    @foreach($pageAttributeTemplate->pageAttributeTemplates as $childPageAttributeTemplate)
        @include('webmixx::page_templates.page_attribute_template', [
            'pageAttributeTemplate' => $childPageAttributeTemplate,
            'base' => '$' . \Illuminate\Support\Str::singular($pageAttributeTemplate->slug)
        ])
    @endforeach
    {{ '@@endforeach' }}
@elseif($pageAttributeTemplate->field_type === \SjorsvanLeeuwen\Webmixx\ValueObjects\FieldTypes::COMPOUND)
    @foreach($pageAttributeTemplate->pageAttributeTemplates as $childPageAttributeTemplate)
        @include('webmixx::page_templates.page_attribute_template', [
            'pageAttributeTemplate' => $childPageAttributeTemplate,
            'base' => $base . '->' . $pageAttributeTemplate->slug
        ])
    @endforeach
@elseif($pageAttributeTemplate->field_type === \SjorsvanLeeuwen\Webmixx\ValueObjects\FieldTypes::MODULE_SET)
    {!! '@@foreach(' . $base . '->' . $pageAttributeTemplate->slug . ' as $' . \Illuminate\Support\Str::singular($pageAttributeTemplate->slug) . ')'  !!}
    {!! '@@dump(' . \Illuminate\Support\Str::singular($pageAttributeTemplate->slug)  . ')' !!}
    {{ '@@endforeach' }}
@elseif($pageAttributeTemplate->field_type === \SjorsvanLeeuwen\Webmixx\ValueObjects\FieldTypes::MODULE_ITEM)
    {!! '@@dump(' . $base . '->' . $pageAttributeTemplate->slug  . ')' !!}
@else
    {!! '&#123;&#123;' !!} {{ $base }}->{{ $pageAttributeTemplate->slug }} {!! '&#125;&#125;' !!}
@endif
