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
        <select class="form-select " name="division" id="division" {{ in_array('division', $required) ? 'required' : '' }}>
            <option value="" data-display="Select a division {{ in_array('division', $required) ? '*' : '' }}">
                Select a division {{ in_array('division', $required) ? '*' : '' }}
            </option>
            @isset($divisions)
                @foreach ($divisions as $division)
                    <option value="{{ $division->id }}" {{ old('division', $selected['division_id'] ?? null) == $division->id ? 'selected' : '' }}>
                        {{ $division->name }}
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
        <select class="form-select " name="district" id="district" {{ in_array('district', $required) ? 'required' : '' }}>
            <option value="" data-display="Select a district {{ in_array('district', $required) ? '*' : '' }}">
                Select district {{ in_array('district', $required) ? '*' : '' }}
            </option>
            @isset($districts)
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}" {{ old('district', $selected['district_id'] ?? null) == $district->id ? 'selected' : '' }}>
                        {{ $district->name }}
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
        <select class="form-select " name="upazila" id="upazila" {{ in_array('upazila', $required) ? 'required' : '' }}>
            <option value="" data-display="Select an Upazila {{ in_array('upazila', $required) ? '*' : '' }}">
                Select an Upazila {{ in_array('upazila', $required) ? '*' : '' }}
            </option>
            @isset($upazilas)
                @foreach ($upazilas as $upazila)
                    <option value="{{ $upazila->id }}" {{ old('upazila', $selected['upazila_id'] ?? null) == $upazila->id ? 'selected' : '' }}>
                        {{ $upazila->name }}
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
        <select class="form-select " name="union" id="union" {{ in_array('union', $required) ? 'required' : '' }}>
            <option value="" data-display="Select a Union {{ in_array('union', $required) ? '*' : '' }}">
                Select a Union {{ in_array('union', $required) ? '*' : '' }}
            </option>
            @isset($unions)
                @foreach ($unions as $union)
                    <option value="{{ $union->id }}" {{ old('union', $selected['union_id'] ?? null) == $union->id ? 'selected' : '' }}>
                        {{ $union->name }}
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
        <select class="form-select " name="village" id="village" {{ in_array('village', $required) ? 'required' : '' }}>
            <option value="" data-display="Select a Village {{ in_array('village', $required) ? '*' : '' }}">
                Select a Village {{ in_array('village', $required) ? '*' : '' }}
            </option>
            @isset($villages)
                @foreach ($villages as $village)
                    <option value="{{ $village->id }}" {{ old('village', $selected['village_id'] ?? null) == $village->id ? 'selected' : '' }}>
                        {{ $village->name }}
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

@section('script')
    <script>
        $(document).ready(function() {
            $("#division").on("change", function() {
                var url = $("#url").val();
                var formData = {
                    id: $(this).val(),
                };
                // get district
                $.ajax({
                    type: "GET",
                    data: formData,
                    dataType: "json",
                    url: "{{ route('division-get-district') }}",

                    success: function(data) {
                        $("#district").empty().append(
                            $("<option>", {
                                value: '',
                                text: 'Select district',
                            })
                        );

                        if (data.length) {
                            $.each(data, function(i, district) {
                                $("#district").append(
                                    $("<option>", {
                                        value: district.id,
                                        text: district.name,
                                    })
                                );
                            });
                        }

                        $('#district').trigger('change');

                        
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                });
            });

            $("#district").on("change", function() {
                var url = $("#url").val();
                var formData = {
                    id: $(this).val(),
                };
                // get upazila
                $.ajax({
                    type: "GET",
                    data: formData,
                    dataType: "json",
                    url: "{{ route('district-get-upazila') }}",

                    success: function(data) {
                        $("#upazila").empty().append(
                            $("<option>", {
                                value: '',
                                text: 'Select upazila',
                            })
                        );

                        if (data.length) {
                            $.each(data, function(i, upazila) {
                                $("#upazila").append(
                                    $("<option>", {
                                        value: upazila.id,
                                        text: upazila.name,
                                    })
                                );
                            });
                        }

                        $('#upazila').trigger('change');

                       
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                });
            });

            $("#upazila").on("change", function() {
                var url = $("#url").val();
                var formData = {
                    id: $(this).val(),
                };
                // get union
                $.ajax({
                    type: "GET",
                    data: formData,
                    dataType: "json",
                    url: "{{ route('upazila-get-union') }}",

                    success: function(data) {
                        $("#union").empty().append(
                            $("<option>", {
                                value: '',
                                text: 'Select union',
                            })
                        );

                        if (data.length) {
                            $.each(data, function(i, union) {
                                $("#union").append(
                                    $("<option>", {
                                        value: union.id,
                                        text: union.name,
                                    })
                                );
                            });
                        }

                        $('#union').trigger('change');

                       
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                });
            });

            $("#union").on("change", function() {
                var url = $("#url").val();
                var formData = {
                    id: $(this).val(),
                };
                // get village
                $.ajax({
                    type: "GET",
                    data: formData,
                    dataType: "json",
                    url: "{{ route('union-get-village') }}",

                    success: function(data) {
                        $("#village").empty().append(
                            $("<option>", {
                                value: '',
                                text: 'Select village',
                            })
                        );

                        if (data.length) {
                            $.each(data, function(i, village) {
                                $("#village").append(
                                    $("<option>", {
                                        value: village.id,
                                        text: village.name,
                                    })
                                );
                            });
                        }

                        $('#village').trigger('change');

                     
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                });
            });
        });
    </script>
@endsection
