<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Report - Professional Dashboard</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary-color: #92278F;
            --secondary-color: #72BF44;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f9fafb;
            --border-color: #e5e7eb;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #ffffff;
            min-height: 100vh;
            padding: 20px;
            font-size: 14px;
            color: var(--text-dark);
        }
        
        .container-main {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
        }
        
        /* Header Section */
        .header-section {
            margin-bottom: 20px;
            padding: 12px 0;
            border-bottom: 2px solid var(--border-color);
        }
        
        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        
        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo-image, .profile-image {
            height: 50px;
            width: 50px;
            object-fit: contain;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            padding: 4px;
            background: #ffffff;
        }
        
        .profile-image {
            object-fit: cover;
            border-radius: 50%;
        }
        
        .header-middle {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
        }
        
        .header-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
            text-align: center;
            margin: 0;
            line-height: 1.3;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .header-right i {
            color: var(--primary-color);
            font-size: 1rem;
        }
        
        /* Mobile Header Layout */
        .header-mobile-top {
            display: none;
        }
        
        .header-mobile-bottom {
            display: none;
        }
        
        /* Card Styles */
        .card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
        }
        
        .card-header {
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .card-body {
            padding: 16px;
        }
        
        /* Statistics Cards */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 12px;
            margin-bottom: 16px;
        }
        
        .stat-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 14px;
            text-align: center;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        
        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            font-size: 16px;
            color: white;
        }
        
        .stat-label {
            color: var(--text-light);
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 4px;
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
            line-height: 1.2;
        }
        
        .stat-meta {
            font-size: 0.7rem;
            color: var(--text-light);
        }
        
        /* Progress Section */
        .progress-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        
        .progress-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .progress-title i {
            color: var(--primary-color);
        }
        
        .progress-percentage {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .progress-track {
            height: 28px;
            background: var(--bg-light);
            border-radius: 6px;
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 10px;
            transition: width 1.5s ease-out;
            position: relative;
        }
        
        .progress-text {
            color: white;
            font-weight: 600;
            font-size: 0.75rem;
            z-index: 1;
        }
        
        /* Table Section */
        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 12px;
        }
        
        .table-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .table-title i {
            color: var(--primary-color);
        }
        
        /* Filter Buttons */
        .filter-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .filter-btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.75rem;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid var(--border-color);
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        
        .filter-btn:not(.active) {
            background: #ffffff;
            color: var(--text-light);
        }
        
        .filter-btn:not(.active):hover {
            background: var(--bg-light);
        }
        
        .filter-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        /* Table */
        .task-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            font-size: 0.875rem;
        }
        
        .task-table thead {
            background: var(--primary-color);
        }
        
        .task-table th {
            padding: 10px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: white;
        }
        
        .task-table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: background 0.15s ease;
        }
        
        .task-table tbody tr:hover {
            background: var(--bg-light);
        }
        
        .task-table td {
            padding: 12px;
            color: var(--text-dark);
        }
        
        .task-number {
            font-weight: 600;
            color: var(--text-light);
            font-variant-numeric: tabular-nums;
        }
        
        .task-name {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 2px;
            font-size: 0.875rem;
        }
        
        .task-description {
            font-size: 0.75rem;
            color: var(--text-light);
            line-height: 1.4;
        }
        
        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }
        
        .status-in-progress {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .status-completed {
            background: #d1fae5;
            color: #065f46;
        }
        
        /* Pagination */
        .pagination-wrapper {
            margin-top: 16px;
            display: flex;
            justify-content: center;
            gap: 6px;
            flex-wrap: wrap;
        }
        
        .pagination-btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.75rem;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid var(--border-color);
        }
        
        .pagination-btn:not(.disabled):not(.active) {
            background: #ffffff;
            color: var(--text-dark);
        }
        
        .pagination-btn:not(.disabled):not(.active):hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .pagination-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .pagination-btn.disabled {
            background: var(--bg-light);
            color: var(--text-light);
            cursor: not-allowed;
            opacity: 0.6;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-light);
        }
        
        .empty-state i {
            font-size: 2.5rem;
            margin-bottom: 12px;
            opacity: 0.4;
        }
        
        .empty-state p {
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 12px;
            }
            
            /* Hide desktop header */
            .header-top {
                display: none;
            }
            
            /* Show mobile header */
            .header-mobile-top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                margin-bottom: 12px;
            }
            
            .header-mobile-bottom {
                display: block;
                text-align: center;
            }
            
            .header-mobile-title {
                font-size: 0.875rem;
                font-weight: 700;
                color: var(--primary-color);
                margin: 0;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 100%;
                line-height: 1.3;
            }
            
            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }
            
            .stat-value {
                font-size: 1.25rem;
            }
        }
        
        @media (max-width: 640px) {
            .header-mobile-title {
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-main">
        <!-- Header -->
        <div class="header-section">
            <!-- Desktop Header -->
            <div class="header-top">
                <!-- Left: Logo/Profile Image -->
                <div class="header-left">
                    @php
                        $user = $project->customer->user ?? null;
                        $profileImage = null;
                        if ($user && !empty($user->profile_image)) {
                            $imagePath = storage_path('app/public/' . $user->profile_image);
                            if (file_exists($imagePath)) {
                                $profileImage = asset('storage/' . $user->profile_image);
                            }
                        }
                    @endphp
                    
                    @if($profileImage)
                        <img src="{{ $profileImage }}" alt="Profile" class="profile-image">
                    @else
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="Logo" class="logo-image">
                    @endif
                </div>
                
                <!-- Middle: Title -->
                <div class="header-middle">
                    <h1 class="header-title">
                        @if(isset($project))
                            {{ $project->title }} Project Report Dashboard
                        @else
                            Task Report Dashboard
                        @endif
                    </h1>
                </div>
                
                <!-- Right: Phone Number -->
                <div class="header-right">
                    <i class="fas fa-phone"></i>
                    <span>+880 1711-432284</span>
                </div>
            </div>
            
            <!-- Mobile Header -->
            <div class="header-mobile-top">
                <!-- Left: Logo/Profile Image -->
                <div class="header-left">
                    @php
                        $user = $project->customer->user ?? null;
                        $profileImage = null;
                        if ($user && !empty($user->profile_image)) {
                            $imagePath = storage_path('app/public/' . $user->profile_image);
                            if (file_exists($imagePath)) {
                                $profileImage = asset('storage/' . $user->profile_image);
                            }
                        }
                    @endphp
                    
                    @if($profileImage)
                        <img src="{{ $profileImage }}" alt="Profile" class="profile-image">
                    @else
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="Logo" class="logo-image">
                    @endif
                </div>
                
                <!-- Right: Phone Number -->
                <div class="header-right">
                    <i class="fas fa-phone"></i>
                    <span>+880 1711-432284</span>
                </div>
            </div>
            
            <!-- Mobile Title (Bottom Line) -->
            <div class="header-mobile-bottom">
                <h1 class="header-mobile-title">
                    @if(isset($project))
                        {{ $project->title }} Project Report Dashboard
                    @else
                        Task Report Dashboard
                    @endif
                </h1>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="stat-grid">
            <!-- Total Tasks -->
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--primary-color);">
                    <i class="fas fa-list-check"></i>
                </div>
                <div class="stat-label">Total Tasks</div>
                <div class="stat-value">{{ number_format($totalTasks) }}</div>
                <div class="stat-meta">All time</div>
            </div>

            <!-- Completed Tasks -->
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--secondary-color);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-label">Completed</div>
                <div class="stat-value">{{ number_format($completedTasks) }}</div>
                <div class="stat-meta">{{ $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100, 1) : 0 }}% done</div>
            </div>

            <!-- Remaining Tasks -->
            <div class="stat-card">
                <div class="stat-icon" style="background: #f59e0b;">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-label">Remaining</div>
                <div class="stat-value">{{ number_format($remainTasks) }}</div>
                <div class="stat-meta">In progress</div>
            </div>

            <!-- Last 7 Days -->
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--primary-color);">
                    <i class="fas fa-calendar-week"></i>
                </div>
                <div class="stat-label">Last 7 Days</div>
                <div class="stat-value">{{ number_format($last7DaysCompleted) }}</div>
                <div class="stat-meta">This week</div>
            </div>

            <!-- Last Month -->
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--secondary-color);">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-label">Last Month</div>
                <div class="stat-value">{{ number_format($lastMonthCompleted) }}</div>
                <div class="stat-meta">This month</div>
            </div>
        </div>

        <!-- Progress Section -->
        <div class="card">
            <div class="card-body">
                <div class="progress-header">
                    <h2 class="progress-title">
                        <i class="fas fa-chart-pie"></i>
                        Overall Progress
                    </h2>
                    <div class="progress-percentage">{{ number_format($progressPercentage, 1) }}%</div>
                </div>
                <div class="progress-track">
                    <div class="progress-fill" 
                         style="width: {{ $progressPercentage }}%"
                         data-progress="{{ $progressPercentage }}">
                        @if($progressPercentage >= 8)
                            <span class="progress-text">{{ number_format($progressPercentage, 1) }}%</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Task List Section -->
        <div class="card">
            <div class="card-header">
                <div class="table-header">
                    <h2 class="table-title">
                        <i class="fas fa-list"></i>
                        Task List
                    </h2>
                    
                    <!-- Status Filter -->
                    <div class="filter-group">
                        <button type="button" 
                           class="filter-btn filter-status-btn {{ $statusFilter == 'all' ? 'active' : '' }}"
                           data-status="all">
                            <i class="fas fa-th-large"></i>
                            <span>All</span>
                        </button>
                        <button type="button" 
                           class="filter-btn filter-status-btn {{ $statusFilter == '0' ? 'active' : '' }}"
                           data-status="0">
                            <i class="fas fa-clock"></i>
                            <span>Pending</span>
                        </button>
                        <button type="button" 
                           class="filter-btn filter-status-btn {{ $statusFilter == '1' ? 'active' : '' }}"
                           data-status="1">
                            <i class="fas fa-check-circle"></i>
                            <span>Completed</span>
                        </button>
                        <button type="button" 
                           class="filter-btn filter-status-btn {{ $statusFilter == '2' ? 'active' : '' }}"
                           data-status="2">
                            <i class="fas fa-spinner"></i>
                            <span>In Progress</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="card-body" style="padding: 0;">
                <!-- Task Table -->
                <div class="overflow-x-auto">
                    <table class="task-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="task-table-body">
                            @forelse($tasks as $index => $task)
                                <tr>
                                    <td class="task-number">{{ $tasks->firstItem() + $index }}</td>
                                    <td>
                                        <div class="task-name">{{ $task->title }}</div>
                                        @if($task->description)
                                            <div class="task-description">{{ Str::limit($task->description, 60) }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($task->status == 1)
                                            <span class="status-badge status-completed">
                                                <i class="fas fa-check-circle"></i>
                                                <span>Completed</span>
                                            </span>
                                        @elseif($task->status == 2)
                                            <span class="status-badge status-in-progress">
                                                <i class="fas fa-spinner fa-spin"></i>
                                                <span>In Progress</span>
                                            </span>
                                        @else
                                            <span class="status-badge status-pending">
                                                <i class="fas fa-clock"></i>
                                                <span>Pending</span>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <p>No tasks found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div id="pagination-wrapper">
                    @if($tasks->hasPages())
                        <div class="card-body" style="padding-top: 16px; border-top: 1px solid var(--border-color);">
                            <div class="pagination-wrapper">
                                @if($tasks->onFirstPage())
                                    <span class="pagination-btn disabled">&laquo; Previous</span>
                                @else
                                    <a href="{{ $tasks->previousPageUrl() }}" 
                                       class="pagination-btn pagination-link">&laquo; Previous</a>
                                @endif

                                @foreach($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                                    @if($page == $tasks->currentPage())
                                        <span class="pagination-btn active">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" 
                                           class="pagination-btn pagination-link">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if($tasks->hasMorePages())
                                    <a href="{{ $tasks->nextPageUrl() }}" 
                                       class="pagination-btn pagination-link">Next &raquo;</a>
                                @else
                                    <span class="pagination-btn disabled">Next &raquo;</span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate progress bar on load
            const progressFill = document.querySelector('.progress-fill');
            if (progressFill) {
                const progressValue = progressFill.getAttribute('data-progress');
                progressFill.style.width = '0%';
                setTimeout(() => {
                    progressFill.style.width = progressValue + '%';
                }, 300);
            }

            // AJAX Status Filter
            const filterButtons = document.querySelectorAll('.filter-status-btn');
            const taskTableBody = document.getElementById('task-table-body');
            const paginationWrapper = document.getElementById('pagination-wrapper');
            const currentUrl = window.location.href;
            const urlParts = currentUrl.split('/');
            const slug = urlParts[urlParts.length - 1].split('?')[0]; // Get slug from URL

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const status = this.getAttribute('data-status');
                    
                    // Update active state
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Show loading state
                    taskTableBody.innerHTML = '<tr><td colspan="3" class="empty-state"><i class="fas fa-spinner fa-spin"></i><p>Loading...</p></td></tr>';
                    
                    // Make AJAX request
                    fetch(`{{ url('task-report') }}/${slug}?status=${status}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update task table
                            if (data.empty) {
                                taskTableBody.innerHTML = '<tr><td colspan="3" class="empty-state"><i class="fas fa-inbox"></i><p>No tasks found</p></td></tr>';
                            } else {
                                let html = '';
                                data.tasks.forEach(task => {
                                    let statusHtml = '';
                                    if (task.status == 1) {
                                        statusHtml = '<span class="status-badge status-completed"><i class="fas fa-check-circle"></i><span>Completed</span></span>';
                                    } else if (task.status == 2) {
                                        statusHtml = '<span class="status-badge status-in-progress"><i class="fas fa-spinner fa-spin"></i><span>In Progress</span></span>';
                                    } else {
                                        statusHtml = '<span class="status-badge status-pending"><i class="fas fa-clock"></i><span>Pending</span></span>';
                                    }
                                    
                                    html += `
                                        <tr>
                                            <td class="task-number">${task.number}</td>
                                            <td>
                                                <div class="task-name">${task.title}</div>
                                                ${task.description ? '<div class="task-description">' + task.description_short + '</div>' : ''}
                                            </td>
                                            <td>${statusHtml}</td>
                                        </tr>
                                    `;
                                });
                                taskTableBody.innerHTML = html;
                            }
                            
                            // Update pagination
                            if (data.pagination.has_pages) {
                                let paginationHtml = '<div class="card-body" style="padding-top: 16px; border-top: 1px solid var(--border-color);"><div class="pagination-wrapper">';
                                
                                // Previous button
                                if (data.pagination.on_first_page) {
                                    paginationHtml += '<span class="pagination-btn disabled">&laquo; Previous</span>';
                                } else {
                                    paginationHtml += `<a href="${data.pagination.previous_page_url}" class="pagination-btn pagination-link">&laquo; Previous</a>`;
                                }
                                
                                // Page numbers
                                Object.entries(data.pagination.url_range).forEach(([page, url]) => {
                                    if (page == data.pagination.current_page) {
                                        paginationHtml += `<span class="pagination-btn active">${page}</span>`;
                                    } else {
                                        paginationHtml += `<a href="${url}" class="pagination-btn pagination-link">${page}</a>`;
                                    }
                                });
                                
                                // Next button
                                if (data.pagination.has_more_pages) {
                                    paginationHtml += `<a href="${data.pagination.next_page_url}" class="pagination-btn pagination-link">Next &raquo;</a>`;
                                } else {
                                    paginationHtml += '<span class="pagination-btn disabled">Next &raquo;</span>';
                                }
                                
                                paginationHtml += '</div></div>';
                                paginationWrapper.innerHTML = paginationHtml;
                                
                                // Attach click handlers to new pagination links
                                attachPaginationHandlers();
                            } else {
                                paginationWrapper.innerHTML = '';
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        taskTableBody.innerHTML = '<tr><td colspan="3" class="empty-state"><i class="fas fa-exclamation-circle"></i><p>Error loading tasks</p></td></tr>';
                    });
                });
            });

            // Handle pagination clicks via AJAX
            function attachPaginationHandlers() {
                const paginationLinks = document.querySelectorAll('.pagination-link');
                paginationLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const url = this.getAttribute('href');
                        const urlParams = new URLSearchParams(url.split('?')[1] || '');
                        const status = urlParams.get('status') || 'all';
                        
                        // Show loading state
                        taskTableBody.innerHTML = '<tr><td colspan="3" class="empty-state"><i class="fas fa-spinner fa-spin"></i><p>Loading...</p></td></tr>';
                        
                        // Make AJAX request
                        fetch(url, {
                            method: 'GET',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update task table
                                if (data.empty) {
                                    taskTableBody.innerHTML = '<tr><td colspan="3" class="empty-state"><i class="fas fa-inbox"></i><p>No tasks found</p></td></tr>';
                                } else {
                                    let html = '';
                                    data.tasks.forEach(task => {
                                        let statusHtml = '';
                                        if (task.status == 1) {
                                            statusHtml = '<span class="status-badge status-completed"><i class="fas fa-check-circle"></i><span>Completed</span></span>';
                                        } else if (task.status == 2) {
                                            statusHtml = '<span class="status-badge status-in-progress"><i class="fas fa-spinner fa-spin"></i><span>In Progress</span></span>';
                                        } else {
                                            statusHtml = '<span class="status-badge status-pending"><i class="fas fa-clock"></i><span>Pending</span></span>';
                                        }
                                        
                                        html += `
                                            <tr>
                                                <td class="task-number">${task.number}</td>
                                                <td>
                                                    <div class="task-name">${task.title}</div>
                                                    ${task.description ? '<div class="task-description">' + task.description_short + '</div>' : ''}
                                                </td>
                                                <td>${statusHtml}</td>
                                            </tr>
                                        `;
                                    });
                                    taskTableBody.innerHTML = html;
                                }
                                
                                // Update pagination
                                if (data.pagination.has_pages) {
                                    let paginationHtml = '<div class="card-body" style="padding-top: 16px; border-top: 1px solid var(--border-color);"><div class="pagination-wrapper">';
                                    
                                    // Previous button
                                    if (data.pagination.on_first_page) {
                                        paginationHtml += '<span class="pagination-btn disabled">&laquo; Previous</span>';
                                    } else {
                                        paginationHtml += `<a href="${data.pagination.previous_page_url}" class="pagination-btn pagination-link">&laquo; Previous</a>`;
                                    }
                                    
                                    // Page numbers
                                    Object.entries(data.pagination.url_range).forEach(([page, url]) => {
                                        if (page == data.pagination.current_page) {
                                            paginationHtml += `<span class="pagination-btn active">${page}</span>`;
                                        } else {
                                            paginationHtml += `<a href="${url}" class="pagination-btn pagination-link">${page}</a>`;
                                        }
                                    });
                                    
                                    // Next button
                                    if (data.pagination.has_more_pages) {
                                        paginationHtml += `<a href="${data.pagination.next_page_url}" class="pagination-btn pagination-link">Next &raquo;</a>`;
                                    } else {
                                        paginationHtml += '<span class="pagination-btn disabled">Next &raquo;</span>';
                                    }
                                    
                                    paginationHtml += '</div></div>';
                                    paginationWrapper.innerHTML = paginationHtml;
                                    
                                    // Update URL without reload
                                    window.history.pushState({}, '', url);
                                    
                                    // Re-attach handlers
                                    attachPaginationHandlers();
                                } else {
                                    paginationWrapper.innerHTML = '';
                                }
                                
                                // Scroll to top of task list
                                document.querySelector('.task-table').scrollIntoView({ behavior: 'smooth', block: 'start' });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            taskTableBody.innerHTML = '<tr><td colspan="3" class="empty-state"><i class="fas fa-exclamation-circle"></i><p>Error loading tasks</p></td></tr>';
                        });
                    });
                });
            }

            // Initial attach pagination handlers
            attachPaginationHandlers();
        });
    </script>
</body>
</html>
