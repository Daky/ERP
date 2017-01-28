@if (isset($breadcrumbs))
<ol class="breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
    <li>
        @if (!is_null($breadcrumb->href)) <a href="{{ $breadcrumb->href }}"> @endif
        @if (!is_null($breadcrumb->title)) {{ $breadcrumb->title }}@endif
        @if (!is_null($breadcrumb->href)) </a> @endif
    </li>
    @endforeach
</ol>
@endif