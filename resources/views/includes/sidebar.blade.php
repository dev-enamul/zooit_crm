 
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
                                <li><a href="{{ url('employee/attendance-summary') }}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Attendance Summary</a></li>  
                                <li><a href="{{ url('employee/daily-attendance') }}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Daily Attendance</a></li>  

                            </ul>
                        </li>  
                    @endcan   
    
                    @can('lead')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="fas fa-handshake"></i>
                            <span>Lead</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false"> 
                            <li><a href="{{route('customer.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Lead Entry</a></li>                            
                            <li class="{{ Route::is('customer.edit') ? 'mm-active' : '' }}"><a href="{{route('customer.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Lead List</a></li>                     
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
                        </ul>
                    </li> 
                    @endcan   

                    @can('meeting')
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="mdi mdi-calendar-check"></i>
                                <span>Meeting</span>
                            </a> 
                            <ul class="sub-menu" aria-expanded="false"> 
                                <li>
                                    <a href="{{route('meeting.create')}}"> 
                                        <i class="mdi mdi-checkbox-blank-circle align-middle"></i>Meeting Create
                                    </a>
                                </li>  
                                <li>
                                    <a href="{{route('meeting.index')}}">
                                        <i class="mdi mdi-checkbox-blank-circle align-middle"></i>Meeting Schedule
                                    </a>
                                </li>
                            </ul>
                        </li>  
                    @endcan

                    @can('invoice') 
                    <li>
                        <a href="{{route('invoice.index')}}" class="">
                            <i class="mdi mdi-file-document"></i>
                            <span>Invoice</span>
                        </a>
                    </li>  
                    @endcan 

                    @can('deposit')
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="mdi mdi-bank-transfer"></i>
                                <span>Deposit</span>
                            </a> 
                            <ul class="sub-menu" aria-expanded="false"> 
                                <li>
                                    <a href="{{route('deposit.create')}}"> 
                                        <i class="mdi mdi-checkbox-blank-circle align-middle"></i>Deposit Create
                                    </a>
                                </li>  
                                <li>
                                    <a href="{{route('deposit.index')}}">
                                        <i class="mdi mdi-checkbox-blank-circle align-middle"></i>Deposit List
                                    </a>
                                </li>
                            </ul>
                        </li> 
                    @endcan

                    

                    @can('setting')
                        <div class="">
                            <div class="menu-title-box" data-bs-toggle="collapse" data-bs-target="#Setting" aria-expanded="false" aria-controls="collapseExample">
                                <h3 class="menu-title">Setting</h3>
                                <div class="card-addon me-3">
                                    <button class="btn btn-label-info btn-sm btn-icon">
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="collapse" id="Setting">
                                @can('designation-setting')
                                    <li>
                                        <a href="{{route('designation.index')}}" class="">
                                            <i class="fas fa-user-tag"></i> <!-- Icon for Designation -->
                                            <span>Designation</span>
                                        </a>
                                    </li>
                                @endcan
                        
                                @can('bank-setting')
                                    <li>
                                        <a href="{{route('bank.index')}}" class="">
                                            <i class="fas fa-university"></i> <!-- Icon for Bank -->
                                            <span>Bank</span>
                                        </a>
                                    </li>
                                @endcan
                        
                                @can('service-setting')
                                    <li>
                                        <a href="{{route('service.index')}}" class="">
                                            <i class="fas fa-concierge-bell"></i> <!-- Icon for Service -->
                                            <span>Service</span>
                                        </a>
                                    </li>
                                @endcan
                        
                                @can('lead-source-setting')
                                    <li>
                                        <a href="{{route('lead-source.index')}}" class="">
                                            <i class="fas fa-bullhorn"></i> <!-- Icon for Lead Find Media -->
                                            <span>Lead Find Media</span>
                                        </a>
                                    </li>
                                @endcan 

                                @can('location-setting')
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
                                            <li><a href="{{route('village.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Village</a></li> 
                                            
                                        </ul>
                                    </li> 
                                @endcan
                            </div>
                        </div> 
                    @endcan  
            </ul>
        </div> 
    </div>
</div>