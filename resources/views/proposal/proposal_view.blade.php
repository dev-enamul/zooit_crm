<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $proposal->title }}</title>
    <script>
        window.proposalData = {!! $proposalJson !!};
    </script>
    <link href="{{ asset('assets/css/project_proposal.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/proposal_custom.css') }}">
</head>
<body>
    <div class="loading-overlay"><div class="loading-spinner"></div></div>
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
                <h2 contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="timeline_title">Timeline</h2>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($section->value['core_features'] as $index => $feature)
                            <tr class="table-row">
                                <td contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="core_features.{{ $index }}.functionality">{{ $feature['functionality'] ?? '' }}</td>
                                <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="{{ $section->id }}" data-field="core_features.{{ $index }}.frontend_price">{{ $feature['frontend_price'] ?? '' }}</td>
                                <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="{{ $section->id }}" data-field="core_features.{{ $index }}.backend_price">{{ $feature['backend_price'] ?? '' }}</td>
                                <td contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="core_features.{{ $index }}.note">{{ $feature['note'] ?? '' }}</td>
                            </tr>
                        @endforeach
                        <tr class="total">
                            <td contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="core_features_total_label"><strong>Total</strong></td>
                            <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="{{ $section->id }}" data-field="core_features_total_frontend"><strong>{{ $section->value['core_features_total_frontend'] }}</strong></td>
                            <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="{{ $section->id }}" data-field="core_features_total_backend"><strong>{{ $section->value['core_features_total_backend'] }}</strong></td>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($section->value['additional_modules'] as $index => $module)
                            <tr class="table-row">
                                <td contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="additional_modules.{{ $index }}.functionality">{{ $module['functionality'] ?? '' }}</td>
                                <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="{{ $section->id }}" data-field="additional_modules.{{ $index }}.frontend_price">{{ $module['frontend_price'] ?? '' }}</td>
                                <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="{{ $section->id }}" data-field="additional_modules.{{ $index }}.backend_price">{{ $module['backend_price'] ?? '' }}</td>
                                <td contenteditable="true" class="editable-field" data-model="section" data-id="{{ $section->id }}" data-field="additional_modules.{{ $index }}.note">{{ $module['note'] ?? '' }}</td>
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

    <div class="chat-container no-print">
        <div class="chat-input" contenteditable="true" placeholder="Enter your message..."></div>
        <button class="chat-send-btn">
            <i class="fas fa-paper-plane"></i>
        </button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/proposal_view.js') }}"></script>
    <script src="{{ asset('assets/js/proposal_ai.js') }}"></script>
</body>
</html>