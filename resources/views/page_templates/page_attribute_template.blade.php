@if($pageAttributeTemplate->repeatable === true)
    {!! '@@foreach(' . $base . '->' . $pageAttributeTemplate->slug . ' as $' . \Illuminate\Support\Str::singular($pageAttributeTemplate->slug) . ')'  !!}
    @foreach($pageAttributeTemplate->pageAttributeTemplates as $childPageAttributeTemplate)
        @include('webmixx::page_templates.page_attribute_template', [
            'pageAttributeTemplate' => $childPageAttributeTemplate,
            'base' => '$' . \Illuminate\Support\Str::singular($pageAttributeTemplate->slug)
        ])
    @endforeach
    {{ '@@endforeach' }}
@elseif($pageAttributeTemplate->field_type === 'compound')
    @foreach($pageAttributeTemplate->pageAttributeTemplates as $childPageAttributeTemplate)
        @include('webmixx::page_templates.page_attribute_template', [
            'pageAttributeTemplate' => $childPageAttributeTemplate,
            'base' => $base . '->' . $pageAttributeTemplate->slug
        ])
    @endforeach
@else
    {{ '{{' }} {{ $base }}->{{ $pageAttributeTemplate->slug }} {!! '}}' !!}
@endif
