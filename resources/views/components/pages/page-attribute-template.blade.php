<div id="attributeTemplate{{ $pageAttributeTemplate->id }}" @if($pageAttributeTemplate->repeatable) class="repeatable" @endif>
    @if($ownedPageAttributes()->isEmpty())
        <x-webmixx-pages:page-attribute :pageTemplate="$pageTemplate" :pageAttributeTemplate="$pageAttributeTemplate" :baseName="$baseName" />
    @else
        @foreach($ownedPageAttributes() as $pageAttribute)
            <x-webmixx-pages:page-attribute :pageTemplate="$pageTemplate" :pageAttributeTemplate="$pageAttributeTemplate" :pageAttributes="$pageAttributes" :baseName="$baseName" :pageAttribute="$pageAttribute"/>
        @endforeach
        @if($pageAttributeTemplate->repeatable)
            <x-webmixx-pages:page-attribute :pageTemplate="$pageTemplate" :pageAttributeTemplate="$pageAttributeTemplate" :baseName="$baseName" />
        @endif
    @endif
</div>
