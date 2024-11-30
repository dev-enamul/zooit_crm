 
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
                                    <li><a href="{{route('employees.tree')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Employee Tree</a></li>  
                                </ul>
                            </li>  
                        @endcan   
    
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
                                <a href="{{route('meeting.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Meeting Schedule</a>
                            </li>
                        </ul>
                    </li>   

                <div class="">
                    <div class="menu-title-box"  data-bs-toggle="collapse" data-bs-target="#Setting" aria-expanded="false" aria-controls="collapseExample">
                        <h3 class="menu-title">Setting</h3>
                        <div class="card-addon me-3">
                            <button class="btn btn-label-info btn-sm btn-icon">
                                <i class="fa fa-angle-down"></i>
                            </button>
                        </div>
                    </div>  
                    <div class="collapse" id="Setting"> 
      

                        @can('designation')
                            <li>
                                <a href="{{route('designation.index')}}" class="">
                                    <i class="fas fa-desktop"></i>
                                    <span>Designation</span>
                                </a>
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
                        
                        <li>
                            <a href="{{route('service.index')}}" class="">
                                <i class="fas fa-desktop"></i>
                                <span>Service</span>
                            </a>
                        </li> 

                        <li>
                            <a href="{{route('lead-source.index')}}" class="">
                                <i class="fas fa-desktop"></i>
                                <span>Lead Find Media</span>
                            </a>
                        </li> 

                    </div>
                </div>   
            </ul>
        </div> 
    </div>
</div>