@php
$div        = isset($div) ? $div : 'col-lg-6';
$mb         = isset($mb) ? $mb : 'mb-3';

$required       = $required ?? [];
$selected       = isset($selected) ? $selected : null;

$division_id    = $selected && isset($selected['division_id']) ? $selected['division_id'] : null;
$district_id    = $selected && isset($selected['district_id']) ? $selected['district_id'] : null;
$upazila_id     = $selected && isset($selected['upazila_id']) ? $selected['upazila_id'] : null;
$union_id       = $selected && isset($selected['union_id']) ? $selected['union_id'] : null;
$village_id     = $selected && isset($selected['village_id']) ? $selected['village_id'] : null;
$project_id     = $selected && isset($selected['project_id']) ? $selected['project_id'] : null;
$visible        = $visible ?? [];

if ($division_id) {
    $districts  = districts($division_id) ?? null;
    $upazilas   = $district_id ? upazilas($district_id, $division_id) : null;
    $unions     = $upazila_id && $district_id && $division_id ? unions($upazila_id, $district_id,$division_id) : null;
    $villages   = $union_id && $upazila_id ? villages($union_id, $upazila_id, $district_id, $division_id) : null;
}
$visible = $visible ?? [];

@endphp

@if (in_array('division', $visible))
    <div class="{{ $div . ' ' . $mb }}">
        <label for="division" class="form-label">Division <span class="text-danger">{{ in_array('division', $required) ? '*' : '' }}</span></label>
        <select class="form-select" name="division" id="division" {{ in_array('division', $required) ? 'required' : '' }}>
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
        <select class="form-select" name="district" id="district" {{ in_array('district', $required) ? 'required' : '' }}>
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
        <select class="form-select" name="upazila" id="upazila" {{ in_array('upazila', $required) ? 'required' : '' }}>
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
        <select class="form-select" name="union" id="union" {{ in_array('union', $required) ? 'required' : '' }}>
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
        <select class="form-select" name="village" id="village" {{ in_array('village', $required) ? 'required' : '' }}>
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

@if (in_array('statusUnit', $visible))
    <div class="{{ $div . ' ' . $mb }}">
        <label for="status" class="form-label">Status <span class="text-danger">{{ in_array('status', $required) ? '*' : '' }}</span></label>
        <select class="form-select" name="status" id="statusUnit" {{ in_array('statusUnit', $required) ? 'required' : '' }}>
            <option value="" data-display="Select a Status {{ in_array('statusUnit', $required) ? '*' : '' }}">
                Select a Status {{ in_array('statusUnit', $required) ? '*' : '' }}
            </option>
            @foreach (\App\Enums\Status::values() as $key => $value)
                <option value="{{ $key }}" {{ old('status', $selected['status'] ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        
        @if ($errors->has('status'))
            <span class="text-danger" role="alert">
                {{ $errors->first('status') }}
            </span>
        @endif
    </div>
@endif

@if (in_array('progressStatus', $visible))
    <div class="{{ $div . ' ' . $mb }}">
        <label for="status" class="form-label">Status <span class="text-danger">{{ in_array('status', $required) ? '*' : '' }}</span></label>
        <select class="form-select" name="status" id="status" {{ in_array('status', $required) ? 'required' : '' }}>
            <option value="" data-display="Select a Status {{ in_array('status', $required) ? '*' : '' }}">
                Select a Status {{ in_array('status', $required) ? '*' : '' }}
            </option>
            @foreach (\App\Enums\ProgressStatus::values() as $key => $value)
                <option value="{{ $key }}" {{ old('status', $selected['status'] ?? null) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        
        @if ($errors->has('status'))
            <span class="text-danger" role="alert">
                {{ $errors->first('status') }}
            </span>
        @endif
    </div>
@endif

@if (in_array('project', $visible))
    <div class="{{ $div . ' ' . $mb }}">
        <label for="project" class="form-label">Project <span class="text-danger">{{ in_array('project', $required) ? '*' : '' }}</span></label>
        <select class="form-select" name="project" id="project" {{ in_array('project', $required) ? 'required' : '' }}>
            <option value="" data-display="Select a Project {{ in_array('project', $required) ? '*' : '' }}">
                Select a Project {{ in_array('project', $required) ? '*' : '' }}
            </option>
            @isset($projects)
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project', $selected['project_id'] ?? null) == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
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
          
@section('script-bottom')
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

                        $('#district').select2({
                        minimumResultsForSearch: Infinity
                        });
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

                        $('#upazila').select2({
                        minimumResultsForSearch: Infinity
                        });
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

                        $('#union').select2({
                        minimumResultsForSearch: Infinity
                        });
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

                        $('#village').select2({
                        minimumResultsForSearch: Infinity
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                });
            });
        });
    </script>
@endsection