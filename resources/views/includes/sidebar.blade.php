@php
    $approve_setting = App\Models\ApproveSetting::pluck('status', 'name')->toArray();  
    $task_route = ['employee.create', 'employee.index', 'employees.tree', 'product.approve', 'freelancer.create', 'freelancer.index', 'approve-freelancer.index', 'customer.create', 'customer.index', 'customer.approve', 'prospecting.create','prospecting.edit', 'prospecting.index', 'prospecting.approve', 'cold-calling.create', 'cold-calling.edit', 'cold-calling.index', 'cold-calling.approve', 'lead.create','lead.edit', 'lead.index', 'lead.approve','presentation.create', 'presentation.edit', 'presentation.index', 'presentation.approve', 'followup.create', 'followup.index', 'followUp.approve','negotiation.create', 'negotiation.edit', 'negotiation.index', 'negotiation.approve',  'rejection.index', 'salse.create', 'salse.index', 'salse.approve', 'existing.salse', 'return.create', 'return.index', 'transfer.create', 'transfer.index', 'deposit.create', 'deposit.index'];
    $progress_route = ['assign.task.list','my.field.target', 'assign.field.target', 'assign.field.target.list', 'my.task', 'task.complete', 'assign.task', 'project.deposit.target', 'direct.deposit.target', 'deposit.target.asign.list', 'my.deposit.target', 'training.create', 'training.show', 'training.index', 'meeting.index', 'meeting.create', 'meeting.show'];
    $report_route = ['monthly.target.achive', 'mst.commission', 'rsa.co.ordinator', 'monthly.dt.achivement', 'dt.achivement', 'daily.deposit', 'special-offer.index', 'special-offer.create', 'marketing.field.report', 'salse.field.report', 'due.report', 'floor.wise.sold.report', 'cc.report', 'pending.report'];
    $setting_route = ['product.create', 'product.index','sub-product.index','company-type.index', 'village.index', 'zone.index', 'area.index','training-category.index', 'designation.index', 'commission.index', 'special-commission.index', 'commission-deducted-setting.index', 'bank.index', 'bank-day.index', 'deposit-category.index', 'approve.setting'];
    $currentRoute = \Request::route()->getName();
@endphp
<div class="sidebar-left"> 
    <div data-simplebar class="h-100"> 
        <!--- Sidebar-menu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="left-menu list-unstyled" id="side-menu"> 
                <li>
                    <a href="{{route('index')}}" class="">
                        <i class="fas fa-desktop"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                 
                
                <div class="">
                    <div class="menu-title-box"  data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                        <h3 class="menu-title" >Task</h3>
                        <div class="card-addon me-3">
                            <button class="btn btn-label-info btn-sm btn-icon">
                                <i class="fa fa-angle-down"></i>
                            </button>
                        </div>
                    </div>
                    <div class="collapse {{in_array($currentRoute,$task_route)?"show":""}}" id="collapseExample1">
                        @can('employee')
                            <li> 
                                <a href="javascript: void(0);" class="has-arrow ">
                                    <i class="fas fa-network-wired"></i>
                                    <span>Employee</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    @can('employee-manage')
                                        <li><a href="{{route('employee.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Join Employee</a></li> 
                                    @endcan
                                    <li><a href="{{route('employee.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Employiees</a></li> 
                                    <li><a href="{{route('employees.tree')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Employee Tree</a></li> 
                                    <li><a href="{{route('employees.hierarchy')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Employee Hierarchy 1</a></li> 
                                    <li><a href="{{route('employees.hierarchy2')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Employee Hierarchy 2</a></li> 
                                </ul>
                            </li>  
                        @endcan  
                    
                        {{-- @can('freelancer')
                            <li>
                                <a href="javascript: void(0);" class="has-arrow ">
                                    <i class="fas fa-network-wired"></i>
                                    <span>FL Recruitment</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    @can('freelancer-manage')
                                        <li><a href="{{route('freelancer.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>FL Recruitment</a></li> 
                                    @endcan    
                                    <li class="{{ Route::is('freelancer.save', 'freelancer.delete','freelancer.search','freelancer.edit') ? 'mm-active' : '' }}"><a href="{{route('freelancer.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Freelancer List</a></li> 
                                    @if (!empty($approve_setting['freelancer']) )
                                        <li><a href="{{route('approve-freelancer.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Freelancer Approve</a></li> 
                                    @endif 
            
                                </ul>
                            </li> 
                        @endcan --}}
    
                    @can('customer')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="fas fa-handshake"></i>
                            <span>Lead</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('customer-manage')
                                <li><a href="{{route('customer.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Lead Entry</a></li> 
                            @endcan
                            <li class="{{ Route::is('customer.edit') ? 'mm-active' : '' }}"><a href="{{route('customer.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Lead List</a></li> 
                    
                        </ul>
                    </li> 
                    @endcan
    
                    @can('prospecting')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow ">
                            <i class="fas fa-project-diagram"></i>
                            <span>Prospectings</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('prospecting-manage')
                                <li><a href="{{route('prospecting.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Prospectings</a></li> 
                            @endcan  
                            <li><a href="{{route('prospecting.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Prospectings</a></li> 
             
                            @if (!empty($approve_setting['prospecting']) )
                                <li><a href="{{route('prospecting.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Prospecting Approve</a></li> 
                            @endif
                        </ul>
                    </li>
                    @endcan
    
                    @can('cold-calling')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow ">
                            <i class="fas fa-directions"></i>
                            <span>Cold Calling</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('cold-calling-manage')
                                <li><a href="{{route('cold-calling.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Cold-Calling Entry</a></li> 
                            @endcan
                            <li><a href="{{route('cold-calling.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Cold Callings</a></li> 
                             
                            @if (!empty($approve_setting['cold_calling']) )
                                <li><a href="{{route('cold-calling.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Cold Calling Approve</a></li> 
                            @endif
                        </ul>
                    </li> 
                    @endcan
                    
                    @can('lead')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow ">
                            <i class="fas fa-people-arrows"></i>
                            <span>Leads</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                           @can('lead-manage')
                                <li><a href="{{route('lead.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Lead</a></li> 
                            @endcan   
                            <li><a href="{{route('lead.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Lead List</a></li>                         
 
                            @if (!empty($approve_setting['lead']) )
                                <li><a href="{{route('lead.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Lead Approve</a></li> 
                            @endif 
                        </ul>
                    </li>
                    @endcan
      
                    @can('presentation')
                        <li>
                            <a href="javascript: void(0);" class="has-arrow ">
                                <i class="mdi mdi-teach"></i>
                                <span>Presentation</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                @can('presentation-manage')
                                    <li><a href="{{route('presentation.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Presentation</a></li> 
                                @endcan
                                <li><a href="{{route('presentation.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Presentation List</a></li>
                                 
                                @if (!empty($approve_setting['presentation']) )
                                    <li><a href="{{route('presentation.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Presentation Approve</a></li> 
                                @endif  
                            </ul>
                        </li>
                    @endcan
     
                    @can('follow-up')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow ">
                            <i class="mdi mdi-human-greeting"></i>
                            <span>Follow Up</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('follow-up-manage')
                                <li><a href="{{route('followup.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Follow Up</a></li> 
                            @endcan
                            <li><a href="{{route('followup.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Follow Up List</a></li>
                            
                            @if (!empty($approve_setting['follow_up']) )
                                <li><a href="{{route('followUp.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Follow Up Approve</a></li> 
                            @endif  
                        </ul>
                    </li>
                    @endcan
     
                    @can('negotiation')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow ">
                            <i class="fas fa-file-contract"></i>
                            <span>Negotiation</span>
                        </a> 
                        <ul class="sub-menu" aria-expanded="false">
                            @can('negotiation-manage')
                                <li><a href="{{route('negotiation.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Negotiations</a></li> 
                            @endcan
                                <li><a href="{{route('negotiation.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Negotiation List</a></li>
                               
                                @if (!empty($approve_setting['negotiation']) )
                                    <li><a href="{{route('negotiation.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Negotiation Approve</a></li> 
                                @endif  
                        </ul>
                    </li> 
                    @endcan
    
                    @can('rejection')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow ">
                            <i class="fas fa-user-times"></i>
                            <span>Rejection</span>
                        </a>  
                        <ul class="sub-menu" aria-expanded="false">
                            @can('rejection-manage')
                                <li><a href="{{route('rejection.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Rejection</a></li> 
                            @endcan
                            <li><a href="{{route('rejection.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Rejections</a></li> 
                            {{-- <li><a href="{{route('rejection.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Rejection Approve</a></li>  --}}
                        </ul>
                    </li>  
                    @endcan
      
                    @can('sales')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow ">
                            <i class=" fas fa-check-double"></i>
                            <span>Sales</span>
                        </a>  
                        <ul class="sub-menu" aria-expanded="false">
                            @can('sales-manage')
                                <li><a href="{{route('salse.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Sales</a></li> 
                            @endcan
                            <li><a href="{{route('salse.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Sales</a></li> 
                            <li><a href="{{route('salse.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Sales Approve</a></li>
                            <li><a href="{{route('existing.salse')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Existing Sales Create</a></li>
                        </ul>
                    </li> 
                    @endcan
    
                     
    
                    @can('sales-return')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow ">
                            <i class="fas fa-user-times"></i>
                            <span>Sales Return</span>
                        </a>  
                        <ul class="sub-menu" aria-expanded="false">
                            @can('sales-return-manage')
                                <li><a href="{{route('return.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Return</a></li> 
                            @endcan
                            <li><a href="{{route('return.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Return List</a></li> 
                        </ul>
                    </li> 
                    @endcan
    
                    @can('sales-transfer')
                        <li>
                            <a href="javascript: void(0);" class="has-arrow ">
                                <i class="fas fa-user-times"></i>
                                <span>Sales Transfer</span>
                            </a>  
                            <ul class="sub-menu" aria-expanded="false">
                                @can('sales-transfer-manage')
                                    <li><a href="{{route('transfer.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Transfer</a></li> 
                                @endcan
                                <li><a href="{{route('transfer.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Transfer List</a></li> 
                            </ul>
                        </li> 
                    @endcan
      
                    @can('deposit')
                        <li>
                            <a href="javascript: void(0);" class="has-arrow ">
                                <i class="fas fa-user-times"></i>
                                <span>Deposit</span>
                            </a>  
                            <ul class="sub-menu" aria-expanded="false">
                               @can('deposit-manage')
                                    <li><a href="{{route('deposit.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Deposit</a></li> 
                                @endcan
                                <li><a href="{{route('deposit.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Deposit List</a></li> 
                            </ul>
                        </li>  
                    @endcan   
                    </div>
                </div>

                <div class="">
                    <div class="menu-title-box">
                        <h3 class="menu-title">Progress</h3>
                        <div class="card-addon me-3">
                            <button class="btn btn-label-info btn-sm btn-icon" data-bs-toggle="collapse" data-bs-target="#Progress" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-angle-down"></i>
                            </button>
                        </div>
                    </div>
                    <div class="collapse {{in_array($currentRoute,$progress_route)?"show":""}}" id="Progress">
                        @can('field-target')
                        <li>
                            <a href="javascript: void(0);" class="has-arrow ">
                                <i class="mdi mdi-teach"></i>
                                <span>Field Target</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false"> 
                                <li><a href="{{route('my.field.target')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>My Target</a></li>
                                <li><a href="{{route('assign.field.target')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Assign Target</a></li>
                                <li><a href="{{route('assign.field.target.list')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Assign Target List</a></li>                            
                            </ul>
                        </li>  
                        @endcan
    
                        @can('daily-task')
                            <li>
                                <a href="javascript: void(0);" class="has-arrow ">
                                    <i class="mdi mdi-teach"></i>
                                    <span>Todo List</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">  
                                    <li><a href="{{route('my.task')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>My Task</a></li> 
                                    <li><a href="{{route('assign.task')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Assign Task</a></li> 
                                    {{-- <li class="{{ Route::is('task.details') ? 'mm-active' : '' }}"><a href="{{route('task.complete')}}"><i class=" mdi mdi-checkbox-blank-circle align-middle"></i>Task Complete</a></li>  --}}
                                    <li><a href="{{route('assign.task.list')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Assign Task List</a></li> 
                                   
                                </ul>
                            </li>  
                        @endcan   
                        @can('book-reading')
    
                        @endcan
                        
    
                        @can('deposit-target')
                        <li>
                            <a href="javascript: void(0);" class="has-arrow ">
                                <i class="mdi mdi-teach"></i>
                                <span>Deposit Target</span>
                            </a>  
                            <ul class="sub-menu" aria-expanded="false"> 
                                <li><a href="{{route('my.deposit.target')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>My Target</a></li>
                                <li><a href="{{route('project.deposit.target')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Project Wise Target</a></li> 
                                {{-- <li><a href="{{route('direct.deposit.target')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Deposit Target</a></li>  --}}
                                <li><a href="{{route('deposit.target.asign.list')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Target Assign List</a></li>
                                <!-- <li><a href="{{route('deposit.target.remain.list')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Remain Target</a></li> -->

                                {{-- @if (auth()->user()->id == 1)
                                    <li><a href="{{route('project.deposit.target')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Project Wise Target</a></li> 
                                    <li><a href="{{route('direct.deposit.target')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Deposit Target</a></li> 
                                    <li><a href="{{route('deposit.target.asign.list')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Target Assign List</a></li>
                                @else 
                                    <li><a href="{{route('my.deposit.target')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>My Target</a></li> 
                                    <li><a href="{{route('deposit.target.asign.list')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Target Asign List</a></li>
                                @endif  --}}
                            </ul>
                        </li> 
                        @endcan 
                        
                        @can('training')
                        <li>
                            <a href="javascript: void(0);" class="has-arrow ">
                                <i class="mdi mdi-teach"></i>
                                <span>Training</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false"> 
                                <li>
                                    <a href="{{route('training.create')}}"> <i class="mdi mdi-checkbox-blank-circle align-middle"></i> Training Create</a>
                                </li>  
                                <li>
                                    <a href="{{route('training.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Training History</a>
                                </li> 
                            </ul>
                        </li> 
                        @endcan  

                        @can('meeting')
                            <li>
                                <a href="javascript: void(0);" class="has-arrow ">
                                    <i class="mdi mdi-teach"></i>
                                    <span>Meeting</span>
                                </a> 
                                <ul class="sub-menu" aria-expanded="false">
                                   
                                    <li>
                                        <a href="{{route('meeting.create')}}"> <i class="mdi mdi-checkbox-blank-circle align-middle"></i>Meeting Create</a>
                                    </li> 

                                    <li>
                                        <a href="{{route('meeting.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Meeting History</a>
                                    </li>
                                </ul>
                            </li> 
                        @endcan 

                        @if (auth()->user()->id == 1)
                            <li>
                                <a href="{{route('admin-notice.index')}}" class="">
                                    <i class="fas fa-desktop"></i>
                                    <span>Send Notice</span>
                                </a>
                            </li>
                        @endif  
                    </div>
                </div>
                 
                <div class="">
                    <div class="menu-title-box">
                        <h3 class="menu-title">Report</h3>
                        <div class="card-addon me-3">
                            <button class="btn btn-label-info btn-sm btn-icon" data-bs-toggle="collapse" data-bs-target="#Report" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-angle-down"></i>
                            </button>
                        </div>
                    </div>
                    <div class="collapse {{in_array($currentRoute,$report_route)?"show":""}}" id="Report">
                        @can('mst-commission')
                            <li>
                                <a href="javascript: void(0);" class="has-arrow ">
                                    <i class="mdi mdi-chart-bar"></i>
                                    <span>MST Commission</span>
                                </a> 
                                <ul class="sub-menu" aria-expanded="false"> 
                                    <li><a href="{{route('monthly.target.achive')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Monthly TA</a></li> 
                                    <li><a href="{{route('mst.commission')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>MST Commission</a></li> 
                                </ul>
                            </li> 
                            @endcan

                            @can('fl-commission')
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow ">
                                        <i class="mdi mdi-chart-bar"></i>
                                        <span>FL Commission</span>
                                    </a> 
                                    <ul class="sub-menu" aria-expanded="false">  
                                        <li><a href="{{route('rsa.co.ordinator')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>RSA & Co-Ordinator</a></li> 
                                    </ul>
                                </li> 
                            @endcan
                            
                            @can('dt-achivement')
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow ">
                                        <i class="mdi mdi-chart-bar"></i>
                                        <span>DT Achivement</span>
                                    </a> 
                                    <ul class="sub-menu" aria-expanded="false"> 
                                        <li><a href="{{route('monthly.dt.achivement')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Monthly & Weekly Report</a></li>
                                        <li><a href="{{route('dt.achivement')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Bank Day Wise Report</a></li> 
                                        <li><a href="{{route('daily.deposit')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Daily Report</a></li> 
                                        
                                    </ul>
                                </li> 
                            @endcan

                            @can('special-offer')
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow ">
                                        <i class="mdi mdi-chart-bar"></i>
                                        <span>Special Offer</span>
                                    </a> 
                                    <ul class="sub-menu" aria-expanded="false"> 
                                        <li><a href="{{route('special-offer.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Offer List</a></li> 
                                        <li><a href="{{route('special-offer.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Offer Create</a></li>
                                    </ul>
                                </li> 
                            @endcan 

                            @can('field-target-report')
                            <li>
                                <a href="javascript: void(0);" class="has-arrow ">
                                    <i class="mdi mdi-teach"></i>
                                    <span>Field Target Report</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">  
                                    <li><a href="{{route('marketing.field.report')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Marketing Ex. Report</a></li> 
                                    <li><a href="{{route('salse.field.report')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Sales Ex. Report</a></li> 
                                </ul>
                            </li>
                            @endcan 

                            @can('due-report')
                                <li>
                                    <a href="{{route('due.report')}}" class="">
                                        <i class="fas fa-desktop"></i>
                                        <span>Due & Over Due</span>
                                    </a>
                                </li> 
                            @endcan

                            {{-- @can('sold-report')
                                <li>
                                    <a href="{{route('floor.wise.sold.report')}}" class="">
                                        <i class="fas fa-desktop"></i>
                                        <span>Sold & Unsold Report</span>
                                    </a>
                                </li> 
                            @endcan  --}}

                            {{-- @can('cc-report')
                                <li>
                                    <a href="{{route('cc.report')}}" class="">
                                        <i class="fas fa-desktop"></i>
                                        <span>CC Report</span>
                                    </a>
                                </li>
                            @endcan   --}}
                            
                            @can('pending-report')
                            <li>
                                <a href="{{route('pending.report')}}" class="">
                                    <i class="fas fa-desktop"></i>
                                    <span>Pending Report</span>
                                </a>
                            </li> 
                            @endcan  
                    </div>
                </div> 

                <div class="">
                    <div class="menu-title-box">
                        <h3 class="menu-title">Setting</h3>
                        <div class="card-addon me-3">
                            <button class="btn btn-label-info btn-sm btn-icon" data-bs-toggle="collapse" data-bs-target="#Setting" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-angle-down"></i>
                            </button>
                        </div>
                    </div> 

                    <div class="collapse {{in_array($currentRoute,$setting_route)?"show":""}}" id="Setting"> 

                        @can('product')
                            <li>
                                <a href="javascript: void(0);" class="has-arrow ">
                                    <i class="fas fa-network-wired"></i>
                                    <span>Product</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    @can('product-manage')
                                        <li><a href="{{route('product.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Create Product</a></li> 
                                    @endcan   

                                    <li class="{{ Route::is('product.index', 'product.edit','product.search') ? 'mm-active' : '' }}">
                                        <a href="{{ route('product.index') }}">
                                            <i class="mdi mdi-checkbox-blank-circle align-middle"></i> Products
                                        </a>
                                    </li> 

                                    @can('product-manage')
                                        <li><a href="{{route('sub-product.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Create Product</a></li> 
                                    @endcan   
                                    <li class="{{ Route::is('product.index', 'product.edit','product.search') ? 'mm-active' : '' }}">
                                        <a href="{{ route('product.index') }}">
                                            <i class="mdi mdi-checkbox-blank-circle align-middle"></i> Products
                                        </a>
                                    </li>  
                                </ul>
                            </li> 
                        @endcan 

                        @can('company-type') 
                        <li>
                            <a href="{{route('company-type.index')}}" class="">
                                <i class="fas fa-desktop"></i>
                                <span>Company Type</span>
                            </a>
                        </li> 
                        @endcan
        
                        @can('location')
                            <li>
                                <a href="javascript: void(0);" class="has-arrow ">
                                    <i class="mdi mdi-chart-bar"></i>
                                    <span>Location</span>
                                </a> 
                                <ul class="sub-menu" aria-expanded="false"> 
                                    <li>
                                        <a href="{{route('upazila.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Thana</a>
                                    </li> 

                                    <li>
                                        <a href="{{route('union.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Union</a>
                                    </li> 
                                    
                                    @can('village')
                                        <li><a href="{{route('village.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Village</a></li> 
                                    @endcan  

                                    @can('zone')
                                        <li><a href="{{route('zone.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Zone</a></li> 
                                    @endcan  

                                    @can('area')
                                        <li><a href="{{route('area.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Area</a></li> 
                                    @endcan
                                </ul>
                            </li> 
                        @endcan

                        @can('unit')
                            <li>
                                <a href="javascript: void(0);" class="has-arrow ">
                                    <i class="mdi mdi-chart-bar"></i>
                                    <span>Unit</span>
                                </a> 
                                <ul class="sub-menu" aria-expanded="false">
                                    @can('unit-type')
                                        <li><a href="{{route('unit.type')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Unit & Down Payment</a></li> 
                                    @endcan 
                                    @can('unit-category')
                                        <li><a href="{{route('unit.category')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Unit Category</a></li> 
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                        @can('training-category')
                            <li>
                                <a href="{{route('training-category.index')}}" class="">
                                    <i class="fas fa-desktop"></i>
                                    <span>Training</span>
                                </a>
                            </li>
                        @endcan 

                        @can('designation')
                            <li>
                                <a href="{{route('designation.index')}}" class="">
                                    <i class="fas fa-desktop"></i>
                                    <span>Designation</span>
                                </a>
                            </li> 
                        @endcan
        

                        @can('commission')
                            <li>
                                <a href="javascript: void(0);" class="has-arrow ">
                                    <i class="mdi mdi-chart-bar"></i>
                                    <span>Commission</span>
                                </a> 
                                <ul class="sub-menu" aria-expanded="false"> 
                                    @can('regular-commission')
                                        <li><a href="{{route('commission.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Regular Commission</a></li> 
                                    @endcan   

                                    @can('special-commission')
                                        <li class="{{ Route::is(['special-commission.create','special-commission.edit']) ? 'mm-active' : '' }}"><a href="{{route('special-commission.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Special Commission</a></li> 
                                    @endcan  

                                    @can('commission-deducation')
                                        <li><a href="{{route('commission-deducted-setting.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Commission Deducation</a></li> 
                                    @endcan
                                </ul>
                            </li> 
                        @endcan
                        
                        @can('bank')
                            <li>
                                <a href="{{route('bank.index')}}" class="">
                                    <i class="fas fa-desktop"></i>
                                    <span>Bank</span>
                                </a>
                            </li> 
                        @endcan 

                        @can('bank-day')
                            <li>
                                <a href="{{route('bank-day.index')}}" class="">
                                    <i class="fas fa-desktop"></i>
                                    <span>Bank Day</span>
                                </a>
                            </li> 
                        @endcan 

                        @can('deposit-category')
                            <li>
                                <a href="{{route('deposit-category.index')}}" class="">
                                    <i class="fas fa-desktop"></i>
                                    <span>Deposit Category</span>
                                </a>
                            </li> 
                        @endcan   


                        @can('approve-setting')
                            <li>
                                <a href="{{route('approve.setting')}}" class="">
                                    <i class="fas fa-desktop"></i>
                                    <span>Approve Setting</span>
                                </a>
                            </li>     
                        @endcan  

                        <li>
                            <a href="{{route('submit.time.setting')}}" class="">
                                <i class="fas fa-desktop"></i>
                                <span>Submit Time Setting</span>
                            </a>
                        </li> 

                        @if (in_array(auth()->user()->id, [1, 3251]))
                            <li>
                                <a href="{{route('user.commission')}}" class="">
                                    <i class="fas fa-desktop"></i>
                                    <span>User Commission</span>
                                </a>
                            </li> 
                        @endif  
                    </div>
                </div>   
            </ul>
        </div> 
    </div>
</div>