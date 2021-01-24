<div class="field-{{ $getFieldTypeClass() }}" data-bound-by="attributeTemplate{{ $pageAttributeTemplate->id }}">
    @if($hasChildAttributes())
        @foreach($getChildPageAttributeTemplates() as $index => $childPageAttributeTemplate)
            <x-webmixx-pages:page-attribute-template :pageTemplate="$pageTemplate" :pageAttributeTemplate="$childPageAttributeTemplate" :pageAttributes="$pageAttributes" :baseName="$getFieldName()" :pageAttribute="$pageAttribute"/>
        @endforeach
    @else
        <x-dynamic-component :component="$getFieldTypeComponent()" :label="$pageAttributeTemplate->name" :name="$getFieldName()" :value="$getValue()" />
    @endif
</div>
