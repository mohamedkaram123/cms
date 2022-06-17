@foreach ($attributes as $attribute)
    <option value="{{ $attribute->id }}">
        {{ $attribute->getTranslation('name') }}</option>
@endforeach
