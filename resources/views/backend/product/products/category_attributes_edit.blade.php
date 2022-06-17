  @foreach ($attributes as $key => $attribute)
      <option value="{{ $attribute->id }}" @if ($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))) selected @endif>
          {{ $attribute->getTranslation('name') }}</option>
  @endforeach
