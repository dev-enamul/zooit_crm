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

                <li class="menu-title">Task</li> 
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
                                <li><a href="{{route('unit.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Create Unit</a></li> 
                            @endcan
                            <li class="{{ Route::is('unit.save', 'project.unit.delete','project.unit.search') ? 'mm-active' : '' }}">
                                <a href="{{route('unit.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Unit List</a>
                            </li>                        
                            
                            @can('product-approve')
                                <li><a href="{{route('product.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Product Approve</a></li>
                            @endcan
                        </ul>
                    </li> 
                @endcan 
                
                @can('freelancer')
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
                        <li><a href="{{route('approve-freelancer.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Freelancer Approve</a></li> 
  
                    </ul>
                </li> 
                @endcan

                @can('customer')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-handshake"></i>
                        <span>Customer Data</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('customer-manage')
                            <li><a href="{{route('customer.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Customer Entry</a></li> 
                        @endcan
                        <li class="{{ Route::is('customer.save', 'customer.delete','customer.search','customer.edit') ? 'mm-active' : '' }}"><a href="{{route('customer.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Customer List</a></li> 
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
                        <li><a href="{{route('prospecting.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Prospecting Approve</a></li> 
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
                        <li><a href="{{route('cold-calling.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Cold Calling Approve</a></li> 
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
                        <li><a href="{{route('lead.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Lead Approve</a></li> 

                        @can('lead-analysis-manage')
                            <li><a href="{{route('lead-analysis.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Lead Analysis Form</a></li> 
                        @endcan 

                        @can('lead-analysis')
                            <li><a href="{{route('lead-analysis.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Lead Analysis List</a></li> 
                            <li><a href="{{route('lead-analysis.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Lead Analysis Approve</a></li> 
                        @endcan
                    </ul>
                </li>
                @endcan
  
                @can('presentation')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow ">
                            <i class="mdi mdi-teach"></i>
                            <span>Visit & Presentation</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('presentation-manage')
                                <li><a href="{{route('presentation.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Presentation</a></li> 
                            @endcan
                            <li><a href="{{route('presentation.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Presentation List</a></li>
                            <li><a href="{{route('presentation.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Presentation Approve</a></li> 

                            @can('visit-analysis-manage')
                                <li><a href="{{route('presentation_analysis.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Visit Analysis Form</a></li> 
                            @endcan 
 
                            @can('visit-analysis')
                            <li><a href="{{route('presentation_analysis.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Visit Analysis List</a></li>  
                            <li><a href="{{route('presentation-analysis.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Presentation Analysis Approve</a></li> 
                            @endcan
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
                        
                        @can('follow-up-analysis-manage')
                            <li><a href="{{route('followup-analysis.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Follow Up Analysis Form</a></li> 
                        @endcan
                       
                        @can('follow-up-analysis')
                            <li><a href="{{route('followup-analysis.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Follow Up Analysis</a></li>  
                        @endcan
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
                        @can('negotiation-analysis-manage')
                            <li><a href="{{route('negotiation-analysis.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Negotiations Analysis Form</a></li> 
                        @endcan
                        @can('negotiation-analysis')
                            <li><a href="{{route('negotiation-analysis.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Negotiation Analysis List</a></li>  
                        @endcan
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

                    <li class="menu-title">Progress</li>  
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
                                <span>Daily Task</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false"> 
                                <li><a href="{{route('my.task')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>My Task</a></li> 
                                <li class="{{ Route::is('task.details') ? 'mm-active' : '' }}"><a href="{{route('task.complete')}}"><i class=" mdi mdi-checkbox-blank-circle align-middle"></i>Task Complete</a></li> 
                                {{-- <li><a href="{{route('assign.task.list')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Assign Task List</a></li>  --}}
                                <li><a href="{{route('assign.task')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Assign Task</a></li> 
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
                            @if (auth()->user()->id == 1)
                                <li><a href="{{route('project.deposit.target')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Project Wise Target</a></li> 
                                <li><a href="{{route('direct.deposit.target')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Deposit Target</a></li> 
                                <li><a href="{{route('deposit.target.asign.list')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Target Assign List</a></li>
                            @else 
                                <li><a href="{{route('my.deposit.target')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>My Target</a></li> 
                                <li><a href="{{route('deposit.target.asign.list')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Target Asign List</a></li>
                            @endif 
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
                            <li><a href="{{route('training.schedule')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Training Schedule</a></li> 
                            <li><a href="{{route('training.attendance')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Training Attendance</a></li> 
                            <li><a href="{{route('training.history')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Training History</a></li> 
                        </ul>
                    </li> 
                    @endcan 
                    @can('meeting')
                    <li>
                        <a href="{{route('meeting.index')}}" class="">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Meeting Schedule</span>
                        </a>
                    </li>   
                    @endcan
                {{-- <li class="menu-title">Asign</li>  
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-teach"></i>
                        <span>Training</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('training.schedule.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Training Create</a></li> 
                        <li><a href="{{route('training.schedule')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Training Schedule</a></li> 
                        <li><a href="{{route('training.attendance')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Training Attendance</a></li> 
                        <li><a href="{{route('training.history')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Training History</a></li> 
                    </ul>
                </li> 
                <li>
                    <a href="{{route('meeting.index')}}" class="">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Meeting Schedule</span>
                    </a>
                </li>    --}}
 
                <li class="menu-title">Report</li>  
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

                @can('sold-report')
                    <li>
                        <a href="{{route('floor.wise.sold.report')}}" class="">
                            <i class="fas fa-desktop"></i>
                            <span>Sold & Unsold Report</span>
                        </a>
                    </li> 
                @endcan 

                @can('cc-report')
                    <li>
                        <a href="{{route('cc.report')}}" class="">
                            <i class="fas fa-desktop"></i>
                            <span>CC Report</span>
                        </a>
                    </li>
                @endcan  
                
                @can('pending-report')
                <li>
                    <a href="{{route('pending.report')}}" class="">
                        <i class="fas fa-desktop"></i>
                        <span>Pending Report</span>
                    </a>
                </li> 
                @endcan  

                @can('setting')
                    <li class="menu-title">Setting</li> 
                    @can('profession') 
                        <li>
                            <a href="{{route('profession.index')}}" class="">
                                <i class="fas fa-desktop"></i>
                                <span>Profession</span>
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
                                {{-- <li><a href="{{route('union.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Union</a></li>  --}}
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
                @endcan
                
                  
            </ul>
        </div> 
    </div>
</div>