@php
    $div        = isset($div) ? $div : 'col-md-6';
    $mb         = isset($mb) ? $mb : 'mb-3';
    $required   = $required ?? [];
    $selected   = isset($selected) ? $selected : null;
    $division_id= $selected && isset($selected['division']) ? $selected['division'] : null;
    $district_id= $selected && isset($selected['district']) ? $selected['district'] : null;
    $upazila_id = $selected && isset($selected['upazila']) ? $selected['upazila'] : null;
    $union_id   = $selected && isset($selected['union']) ? $selected['union'] : null;
    $village_id = $selected && isset($selected['village']) ? $selected['village'] : null;
    $visible = $visible ?? [];
@endphp

@if (in_array('division', $visible))
    <div class="{{ $div . ' ' . $mb }}">
        <label for="division" class="form-label">Division <span class="text-danger">{{ in_array('division', $required) ? '*' : '' }}</span></label>
        <select class="form-select" name="division" id="division" {{ in_array('division', $required) ? 'required' : '' }}>
            <option data-display="Select a division {{ in_array('division', $required) ? '*' : '' }}" value="">
                Select a division {{ in_array('division', $required) ? '*' : '' }}
            </option>
            @isset($divisions)
                @foreach ($divisions as $division)
                    <option value="{{ $division }}" {{ isset($division_id) && $division_id == $division ? 'selected' : '' }}>
                        {{ $division }}
                    </option>
                @endforeach
            @endisset
        </select>

        @if ($errors->has('division'))
            <span class="text-danger" role="alert">
                {{ $errors->first('division') }}
            </span>
        @endif
    </div>
@endif

@if (in_array('district', $visible))
    <div class="{{ $div . ' ' . $mb }}">
        <label for="district" class="form-label">District <span class="text-danger">{{ in_array('district', $required) ? '*' : '' }}</span></label>
        <select class="form-select" name="district" id="district" {{ in_array('district', $required) ? 'required' : '' }}>
            <option data-display="Select a district {{ in_array('district', $required) ? '*' : '' }}" value="">
                Select a district {{ in_array('district', $required) ? '*' : '' }}
            </option>
            @isset($districts)
                @foreach ($districts as $district)
                    <option value="{{ $district }}" {{ isset($district_id) && $district_id == $district ? 'selected' : '' }}>
                        {{ $district }}
                    </option>
                @endforeach
            @endisset
        </select>

        @if ($errors->has('district'))
            <span class="text-danger" role="alert">
                {{ $errors->first('district') }}
            </span>
        @endif
    </div>
@endif

@if (in_array('upazila', $visible))
    <div class="{{ $div . ' ' . $mb }}">
        <label for="upazila" class="form-label">Upazila <span class="text-danger">{{ in_array('upazila', $required) ? '*' : '' }}</span></label>
        <select class="form-select" name="upazila" id="upazila" {{ in_array('upazila', $required) ? 'required' : '' }}>
            <option data-display="Select a upazila {{ in_array('upazila', $required) ? '*' : '' }}" value="">
                Select a Upazila {{ in_array('upazila', $required) ? '*' : '' }}
            </option>
            @isset($upazilas)
                @foreach ($upazilas as $upazila)
                    <option value="{{ $upazila }}" {{ isset($upazila_id) && $upazila_id == $upazila ? 'selected' : '' }}>
                        {{ $upazila }}
                    </option>
                @endforeach
            @endisset
        </select>

        @if ($errors->has('upazila'))
            <span class="text-danger" role="alert">
                {{ $errors->first('upazila') }}
            </span>
        @endif
    </div>
@endif

@if (in_array('union', $visible))
    <div class="{{ $div . ' ' . $mb }}">
        <label for="union" class="form-label">Union <span class="text-danger">{{ in_array('union', $required) ? '*' : '' }}</span></label>
        <select class="form-select" name="union" id="union" {{ in_array('union', $required) ? 'required' : '' }}>
            <option data-display="Select a union {{ in_array('union', $required) ? '*' : '' }}" value="">
                Select a Union {{ in_array('union', $required) ? '*' : '' }}
            </option>
            @isset($unions)
                @foreach ($unions as $union)
                    <option value="{{ $union }}" {{ isset($union_id) && $union_id == $union ? 'selected' : '' }}>
                        {{ $union }}
                    </option>
                @endforeach
            @endisset
        </select>

        @if ($errors->has('union'))
            <span class="text-danger" role="alert">
                {{ $errors->first('union') }}
            </span>
        @endif
    </div>
@endif

@if (in_array('village', $visible))
    <div class="{{ $div . ' ' . $mb }}">
        <label for="village" class="form-label">Village <span class="text-danger">{{ in_array('village', $required) ? '*' : '' }}</span></label>
        <select class="form-select" name="village" id="village" {{ in_array('village', $required) ? 'required' : '' }}>
            <option data-display="Select a village {{ in_array('village', $required) ? '*' : '' }}"
                    value="">
                Select a Village {{ in_array('village', $required) ? '*' : '' }}
            </option>
            @isset($villages)
                @foreach ($villages as $village)
                    <option value="{{ $village }}" {{ isset($village_id) && $village_id == $village ? 'selected' : '' }}>
                        {{ $village }}
                    </option>
                @endforeach
            @endisset
        </select>

        @if ($errors->has('village'))
            <span class="text-danger" role="alert">
                {{ $errors->first('village') }}
            </span>
        @endif
    </div>
@endif