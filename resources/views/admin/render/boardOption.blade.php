@foreach ($standards as $standard)
    <option value="{{ $standard->board_name }}">{{ $standard->board_name }}</option>
@endforeach
