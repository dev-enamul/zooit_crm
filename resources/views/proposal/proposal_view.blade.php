<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $proposal->title }}</title>
    <link href="{{ asset('assets/css/project_proposal.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    @csrf
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="watermark">CONFIDENTIAL</div>
    
    <div class="content">
        <!-- Header only on first page -->
        <div class="header no-print">
            <div class="logo">Z<span class="zoom">O</span><span class="zoom">O</span>M <span class="it">IT</span></div>
            <div class="contact" contenteditable="true" class="editable-field" data-model="proposal" data-id="{{ $proposal->id }}" data-field="contact_info">
                #347, Concept Tower, 68-69, Green Rd, Dhaka 1209<br>
                Tel: +880 XXXX-XXXXXX | Email: info@zoom-it.com | www.zoom-it.com
            </div>
        </div>

        <!-- Title Page -->
        <div class="title-page no-break">
            <h2 contenteditable="true" class="editable-field" data-model="proposal" data-id="{{ $proposal->id }}" data-field="title">{{ $proposal->title }}</h2>
            <h1 contenteditable="true" class="editable-field" data-model="proposal" data-id="{{ $proposal->id }}" data-field="customer_name">{{ $proposal->customer->name }}</h1>
            <div contenteditable="true" class="editable-field" data-model="proposal" data-id="{{ $proposal->id }}" data-field="submitted_by" class="submitted">{{ $proposal->submitted_by }}</div>
            <div contenteditable="true" class="editable-field" data-model="proposal" data-id="{{ $proposal->id }}" data-field="logo_large" class="logo-large">{{ $proposal->logo_large }}</div>
            <div contenteditable="true" class="editable-field" data-model="proposal" data-id="{{ $proposal->id }}" data-field="address" class="address">{{ $proposal->address }}</div>
            <div contenteditable="true" class="editable-field" data-model="proposal" data-id="{{ $proposal->id }}" data-field="date" class="date">Date: {{ \Carbon\Carbon::parse($proposal->date)->format('d F Y') }}</div>
        </div>

        @foreach($proposal->sections as $section)
        <div class="section">
            <h1 contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="title">{{ $section->title }}</h1>
            @if(isset($section->value['content']))
                <div contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="content">{!! $section->value['content'] !!}</div>
            @endif

            @if(isset($section->value['items']) && is_array($section->value['items']))
                <ul class="editable-list" data-field="items" data-id="{{ $section->id }}">
                    @foreach($section->value['items'] as $index => $item)
                        <li class="list-item">
                            <span contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="items.{{ $index }}">{!! $item !!}</span>
                            <span class="list-actions">
                                <i class="fas fa-plus add-item" title="Add Item"></i>
                                <i class="fas fa-trash remove-item" title="Remove Item"></i>
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if(isset($section->value['sub_sections']))
                @foreach($section->value['sub_sections'] as $sub_index => $sub_section)
                    <h2 contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="sub_sections.{{ $sub_index }}.title">{{ $sub_section['title'] }}</h2>
                    @if(isset($sub_section['content']))
                        <div contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="sub_sections.{{ $sub_index }}.content">{!! $sub_section['content'] !!}</div>
                    @endif
                    @if(isset($sub_section['items']) && is_array($sub_section['items']))
                        <ul class="editable-list" data-field="sub_sections.{{ $sub_index }}.items" data-id="{{ $section->id }}">
                            @foreach($sub_section['items'] as $item_index => $item)
                                <li class="list-item">
                                    <span contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="sub_sections.{{ $sub_index }}.items.{{ $item_index }}">{!! $item !!}</span>
                                    <span class="list-actions">
                                        <i class="fas fa-plus add-item" title="Add Item"></i>
                                        <i class="fas fa-trash remove-item" title="Remove Item"></i>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    @if(isset($sub_section['sub_sections']))
                        @foreach($sub_section['sub_sections'] as $sub_sub_index => $sub_sub_section)
                            <h3>
                                <div contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="sub_sections.{{ $sub_index }}.sub_sections.{{ $sub_sub_index }}.title">{{ $sub_sub_section['title'] }}</div>
                            </h3>
                            @if(isset($sub_sub_section['items']) && is_array($sub_sub_section['items']))
                                <ul class="editable-list" data-field="sub_sections.{{ $sub_index }}.sub_sections.{{ $sub_sub_index }}.items" data-id="{{ $section->id }}">
                                    @foreach($sub_sub_section['items'] as $item_index => $item)
                                        <li class="list-item">
                                            <span contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="sub_sections.{{ $sub_index }}.sub_sections.{{ $sub_sub_index }}.items.{{ $item_index }}">{!! $item !!}</span>
                                            <span class="list-actions">
                                                <i class="fas fa-plus add-item" title="Add Item"></i>
                                                <i class="fas fa-trash remove-item" title="Remove Item"></i>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif

            @if(isset($section->value['timeline']) && is_array($section->value['timeline']))
                <h2 contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="timeline_title">Timeline (5–6 Months)</h2>
                <div class="timeline">
                    @foreach($section->value['timeline'] as $index => $item)
                        <div class="timeline-item">
                            <div contenteditable="true" class="editable-field timeline-date" data-model="section" data-id="{{ $section->id }}" data-field="timeline.{{ $index }}.date">{{ $item['date'] }}</div>
                            <p contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="timeline.{{ $index }}.description">{{ $item['description'] }}</p>
                            <span class="timeline-actions">
                                <i class="fas fa-plus add-timeline-item" title="Add Timeline Item"></i>
                                <i class="fas fa-trash remove-timeline-item" title="Remove Timeline Item"></i>
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(isset($section->value['payment_terms']) && is_array($section->value['payment_terms']))
                <h2 contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="payment_terms_title">Payment Terms</h2>
                <ul class="editable-list" data-field="payment_terms" data-id="{{ $section->id }}">
                    @foreach($section->value['payment_terms'] as $index => $term)
                        <li class="list-item">
                            <span contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="payment_terms.{{ $index }}">{!! $term !!}</span>
                            <span class="list-actions">
                                <i class="fas fa-plus add-item" title="Add Item"></i>
                                <i class="fas fa-trash remove-item" title="Remove Item"></i>
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if(isset($section->value['core_features']) && is_array($section->value['core_features']))
                <h2 contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="core_features_title">Step 1 – Core Features & Modules</h2>
                <table class="editable-table" data-field="core_features" data-id="{{ $section->id }}">
                    <thead>
                        <tr>
                            <th contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="core_features_headers.functionality">Functionality</th>
                            <th contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="core_features_headers.frontend_price">Frontend Price</th>
                            <th contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="core_features_headers.backend_price">Backend Price</th>
                            <th contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="core_features_headers.note">Note</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($section->value['core_features'] as $index => $feature)
                            <tr class="table-row">
                                <td contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="core_features.{{ $index }}.functionality">{{ $feature['functionality'] ?? '' }}</td>
                                <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="{{ $section->id }}" data-field="core_features.{{ $index }}.frontend_price">{{ $feature['frontend_price'] ?? '' }}</td>
                                <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="{{ $section->id }}" data-field="core_features.{{ $index }}.backend_price">{{ $feature['backend_price'] ?? '' }}</td>
                                <td contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="core_features.{{ $index }}.note">{{ $feature['note'] ?? '' }}</td>
                                <td class="table-actions">
                                    <i class="fas fa-plus add-row" title="Add Row"></i>
                                    <i class="fas fa-trash remove-row" title="Remove Row"></i>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="total">
                            <td contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="core_features_total_label"><strong>Total</strong></td>
                            <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="{{ $section->id }}" data-field="core_features_total_frontend"><strong>{{ $section->value['core_features_total_frontend'] }}</strong></td>
                            <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="{{ $section->id }}" data-field="core_features_total_backend"><strong>{{ $section->value['core_features_total_backend'] }}</strong></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <p contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="total_development_cost"><strong>Total Development Cost: {{ $section->value['total_development_cost'] }}</strong></p>
                <p contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="yearly_cost"><strong>Yearly Cost: {{ $section->value['yearly_cost'] }}</strong></p>
            @endif

            @if(isset($section->value['additional_modules']) && is_array($section->value['additional_modules']))
                <h2 contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="additional_modules_title">Step 2 – Additional & Advanced Modules</h2>
                <table class="editable-table" data-field="additional_modules" data-id="{{ $section->id }}">
                    <thead>
                        <tr>
                            <th contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="additional_modules_headers.functionality">Functionality</th>
                            <th contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="additional_modules_headers.frontend_price">Frontend Price</th>
                            <th contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="additional_modules_headers.backend_price">Backend Price</th>
                            <th contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="additional_modules_headers.note">Note</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($section->value['additional_modules'] as $index => $module)
                            <tr class="table-row">
                                <td contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="additional_modules.{{ $index }}.functionality">{{ $module['functionality'] ?? '' }}</td>
                                <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="{{ $section->id }}" data-field="additional_modules.{{ $index }}.frontend_price">{{ $module['frontend_price'] ?? '' }}</td>
                                <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="{{ $section->id }}" data-field="additional_modules.{{ $index }}.backend_price">{{ $module['backend_price'] ?? '' }}</td>
                                <td contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="additional_modules.{{ $index }}.note">{{ $module['note'] ?? '' }}</td>
                                <td class="table-actions">
                                    <i class="fas fa-plus add-row" title="Add Row"></i>
                                    <i class="fas fa-trash remove-row" title="Remove Row"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if(isset($section->value['highlight']))
                <div class="highlight-box">
                    <p contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="highlight">{!! $section->value['highlight'] !!}</p>
                </div>
            @endif

            @if(isset($section->value['signature_area']) && is_array($section->value['signature_area']))
                <div class="signature-area">
                    @foreach($section->value['signature_area'] as $index => $line)
                        <p contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="signature_area.{{ $index }}">{!! $line !!}</p>
                    @endforeach
                    <div class="signature-line"></div>
                </div>
            @endif
        </div>
        @endforeach

        <div class="footer" contenteditable="true" class="editable-field" data-model="proposal" data-id="{{ $proposal->id }}" data-field="footer_info">
            ZOOM IT | #347, Concept Tower, 68-69, Green Rd, Dhaka 1209 | Tel: +880 XXXX-XXXXXX | Email: info@zoom-it.com
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Editable field updates
            $(document).on('blur', '.editable-field', function() {
                var $this = $(this);
                var field = $this.data('field');
                var model = $this.data('model');
                var id = $this.data('id');
                var value = $this.html();

                if (!field || !model || !id || value === $this.data('last-value')) {
                    return;
                }

                $this.data('last-value', value);

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    _token: csrfToken,
                    model: model,
                    id: id,
                    field: field,
                    value: value
                };

                // If updating a list item (e.g., items.9), send the entire items array
                if (field.includes('items.') || field.includes('payment_terms.') || field.includes('signature_area.')) {
                    var $list = $this.closest('.editable-list');
                    var listField = field.split('.').slice(0, -1).join('.'); // e.g., items or payment_terms
                    var items = [];
                    $list.find('.list-item .editable-field').each(function() {
                        items.push($(this).html());
                    });
                    data.field = listField; // Send the base field (e.g., items)
                    data.value = items; // Send the entire array
                }

                $.ajax({
                    url: '/proposal/update-field',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function(response) {
                        console.log('Update successful:', response);
                        $this.addClass('saved').delay(1000).queue(function() {
                            $(this).removeClass('saved').dequeue();
                        });
                    },
                    error: function(xhr) {
                        console.error('Update failed:', xhr);
                        alert('Failed to save changes: ' + (xhr.responseJSON?.error || 'Unknown error'));
                    }
                });
            });

            // Store initial values
            $('.editable-field').each(function() {
                $(this).data('last-value', $(this).html());
            });

            // Add list item
            $(document).on('click', '.add-item', function() {
                var $list = $(this).closest('.editable-list');
                var $item = $(this).closest('.list-item');
                var sectionId = $list.data('id');
                var field = $list.data('field');
                var index = $item.index();
                var $referenceItem = $item; // Fix: Copy from the current item

                var newContent = $referenceItem.find('.editable-field').html() || 'New Item';
                var newIndex = index + 1;

                // Insert new item
                var $newItem = $(`
                    <li class="list-item">
                        <span contenteditable="true" class="editable-field" data-model="section" data-id="${sectionId}" data-field="${field}.${newIndex}">${newContent}</span>
                        <span class="list-actions">
                            <i class="fas fa-plus add-item" title="Add Item"></i>
                            <i class="fas fa-trash remove-item" title="Remove Item"></i>
                        </span>
                    </li>
                `);
                $newItem.find('.editable-field').data('last-value', newContent); // Fix: Set initial last-value for new field
                $item.after($newItem);

                // Update backend
                updateList($list);
            });

            // Remove list item
            $(document).on('click', '.remove-item', function() {
                var $list = $(this).closest('.editable-list');
                var $item = $(this).closest('.list-item');
                var count = $list.find('.list-item').length;

                if (count <= 1) {
                    alert('Cannot remove the last item.');
                    return;
                }

                $item.remove();
                updateList($list);
            });

            // Add table row
            $(document).on('click', '.add-row', function() {
                var $table = $(this).closest('.editable-table');
                var $row = $(this).closest('.table-row');
                var sectionId = $table.data('id');
                var field = $table.data('field');
                var index = $row.index();
                var $referenceRow = $row; // Fix: Copy from the current row

                var newData = {
                    functionality: $referenceRow.find('td').eq(0).html() || 'New Functionality',
                    frontend_price: $referenceRow.find('td').eq(1).html() || '',
                    backend_price: $referenceRow.find('td').eq(2).html() || '',
                    note: $referenceRow.find('td').eq(3).html() || ''
                };
                var newIndex = index + 1;

                // Insert new row
                var $newRow = $(`
                    <tr class="table-row">
                        <td contenteditable="true" class="editable-field" data-model="section" data-id="${sectionId}" data-field="${field}.${newIndex}.functionality">${newData.functionality}</td>
                        <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="${sectionId}" data-field="${field}.${newIndex}.frontend_price">${newData.frontend_price}</td>
                        <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="${sectionId}" data-field="${field}.${newIndex}.backend_price">${newData.backend_price}</td>
                        <td contenteditable="true" class="editable-field" data-model="section" data-id="${sectionId}" data-field="${field}.${newIndex}.note">${newData.note}</td>
                        <td class="table-actions">
                            <i class="fas fa-plus add-row" title="Add Row"></i>
                            <i class="fas fa-trash remove-row" title="Remove Row"></i>
                        </td>
                    </tr>
                `);
                $newRow.find('.editable-field').each(function() {
                    $(this).data('last-value', $(this).html()); // Fix: Set initial last-value for new fields
                });
                $row.after($newRow);

                // Update backend
                updateTable($table);
            });

            // Remove table row
            $(document).on('click', '.remove-row', function() {
                var $table = $(this).closest('.editable-table');
                var $row = $(this).closest('.table-row');
                var count = $table.find('.table-row').length;

                if (count <= 1) {
                    alert('Cannot remove the last row.');
                    return;
                }

                $row.remove();
                updateTable($table);
            });

            // Add timeline item
            $(document).on('click', '.add-timeline-item', function() {
                var $timeline = $(this).closest('.timeline');
                var $item = $(this).closest('.timeline-item');
                var sectionId = $timeline.find('.editable-field').data('id');
                var index = $item.index();
                var $referenceItem = $item; // Fix: Copy from the current item

                var newDate = $referenceItem.find('.timeline-date').html() || 'New Date';
                var newDescription = $referenceItem.find('p').html() || 'New Description';
                var newIndex = index + 1;

                // Insert new timeline item
                var $newItem = $(`
                    <div class="timeline-item">
                        <div contenteditable="true" class="editable-field timeline-date" data-model="section" data-id="${sectionId}" data-field="timeline.${newIndex}.date">${newDate}</div>
                        <p contenteditable="true" class="editable-field" data-model="section" data-id="${sectionId}" data-field="timeline.${newIndex}.description">${newDescription}</p>
                        <span class="timeline-actions">
                            <i class="fas fa-plus add-timeline-item" title="Add Timeline Item"></i>
                            <i class="fas fa-trash remove-timeline-item" title="Remove Timeline Item"></i>
                        </span>
                    </div>
                `);
                $newItem.find('.editable-field').each(function() {
                    $(this).data('last-value', $(this).html()); // Fix: Set initial last-value for new fields
                });
                $item.after($newItem);

                // Update backend
                updateTimeline($timeline);
            });

            // Remove timeline item
            $(document).on('click', '.remove-timeline-item', function() {
                var $timeline = $(this).closest('.timeline');
                var $item = $(this).closest('.timeline-item');
                var count = $timeline.find('.timeline-item').length;

                if (count <= 1) {
                    alert('Cannot remove the last timeline item.');
                    return;
                }

                $item.remove();
                updateTimeline($timeline);
            });

            // Update list in backend
            function updateList($list) {
                var sectionId = $list.data('id');
                var field = $list.data('field');
                var items = [];
                $list.find('.list-item .editable-field').each(function() {
                    items.push($(this).html());
                });

                $.ajax({
                    url: '/proposal/update-field',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        model: 'section',
                        id: sectionId,
                        field: field,
                        value: items
                    }),
                    success: function(response) {
                        console.log('List updated:', response);
                        // Reindex data-field attributes
                        $list.find('.list-item').each(function(index) {
                            $(this).find('.editable-field').attr('data-field', `${field}.${index}`);
                        });
                    },
                    error: function(xhr) {
                        console.error('List update failed:', xhr);
                        alert('Failed to save list: ' + (xhr.responseJSON?.error || 'Unknown error'));
                    }
                });
            }

            // Update table in backend
            function updateTable($table) {
                var sectionId = $table.data('id');
                var field = $table.data('field');
                var rows = [];
                $table.find('.table-row').each(function() {
                    var $cells = $(this).find('td.editable-field');
                    rows.push({
                        functionality: $cells.eq(0).html(),
                        frontend_price: $cells.eq(1).html(),
                        backend_price: $cells.eq(2).html(),
                        note: $cells.eq(3).html()
                    });
                });

                $.ajax({
                    url: '/proposal/update-field',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        model: 'section',
                        id: sectionId,
                        field: field,
                        value: rows
                    }),
                    success: function(response) {
                        console.log('Table updated:', response);
                        // Reindex data-field attributes
                        $table.find('.table-row').each(function(index) {
                            var $cells = $(this).find('.editable-field');
                            $cells.eq(0).attr('data-field', `${field}.${index}.functionality`);
                            $cells.eq(1).attr('data-field', `${field}.${index}.frontend_price`);
                            $cells.eq(2).attr('data-field', `${field}.${index}.backend_price`);
                            $cells.eq(3).attr('data-field', `${field}.${index}.note`);
                        });
                    },
                    error: function(xhr) {
                        console.error('Table update failed:', xhr);
                        alert('Failed to save table: ' + (xhr.responseJSON?.error || 'Unknown error'));
                    }
                });
            }

            // Update timeline in backend
            function updateTimeline($timeline) {
                var sectionId = $timeline.find('.editable-field').data('id');
                var field = 'timeline';
                var items = [];
                $timeline.find('.timeline-item').each(function() {
                    items.push({
                        date: $(this).find('.timeline-date').html(),
                        description: $(this).find('p').html()
                    });
                });

                $.ajax({
                    url: '/proposal/update-field',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        model: 'section',
                        id: sectionId,
                        field: field,
                        value: items
                    }),
                    success: function(response) {
                        console.log('Timeline updated:', response);
                        // Reindex data-field attributes
                        $timeline.find('.timeline-item').each(function(index) {
                            $(this).find('.timeline-date').attr('data-field', `timeline.${index}.date`);
                            $(this).find('p').attr('data-field', `timeline.${index}.description`);
                        });
                    },
                    error: function(xhr) {
                        console.error('Timeline update failed:', xhr);
                        alert('Failed to save timeline: ' + (xhr.responseJSON?.error || 'Unknown error'));
                    }
                });
            }
        });
    </script>
</body>
</html>