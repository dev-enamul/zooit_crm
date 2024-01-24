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
                 
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fas fa-network-wired"></i>
                        <span>Employee</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('employee.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Join Employee</a></li> 
                        <li><a href="{{route('employee.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Employies</a></li> 
                        <li><a href="{{route('employees.tree')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Employee Tree</a></li> 
                    </ul>
                </li> 

 
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fas fa-network-wired"></i>
                        <span>Product</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('product.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Create Product</a></li> 
                        <li class="{{ Route::is('product.index', 'product.edit') ? 'mm-active' : '' }}">
                            <a href="{{ route('product.index') }}">
                                <i class="mdi mdi-checkbox-blank-circle align-middle"></i> Products
                            </a>
                        </li>
                                                
                        <li><a href="{{route('unit.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Create Unit</a></li> 
                        <li><a href="{{route('unit.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Unit List</a></li>                        
                        
                        <li><a href="{{route('product.approve')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Product Approve</a></li>
                    </ul>
                </li>   
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fas fa-network-wired"></i>
                        <span>FL Recruitment</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('freelancer.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>FL Recruitment</a></li> 
                        <li><a href="{{route('freelancer.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Freelancer List</a></li> 
                    </ul>
                </li>  

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-handshake"></i>
                        <span>Customer Data</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('customer.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Customer Entry</a></li> 
                        <li><a href="{{route('customer.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Customer List</a></li> 
                    </ul>
                </li> 

                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fas fa-project-diagram"></i>
                        <span>Prospectings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('prospecting.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Prospectings</a></li> 
                        <li><a href="{{route('prospecting.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Prospectings</a></li> 
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fas fa-directions"></i>
                        <span>Cold Calling</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('cold-calling.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Cold-Calling Entry</a></li> 
                        <li><a href="{{route('cold-calling.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Cold Callings</a></li> 
                    </ul>
                </li> 
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fas fa-people-arrows"></i>
                        <span>Leads</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('lead.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Lead</a></li> 
                        <li><a href="{{route('lead.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Lead List</a></li> 
                        <li><a href="{{route('lead-analysis.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Lead Analysis Form</a></li> 
                        <li><a href="{{route('lead-analysis.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Lead Analysis List</a></li> 
                    </ul>
                </li>
  
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-teach"></i>
                        <span>Visit & Presentation</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('presentation.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Presentation</a></li> 
                        <li><a href="{{route('presentation.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Presentation List</a></li>
                        <li><a href="{{route('presentation_analysis.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Visit Analysis Form</a></li> 
                        <li><a href="{{route('presentation_analysis.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Visit Analysis List</a></li>  
                    </ul>
                </li>
 
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-human-greeting"></i>
                        <span>Follow Up</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('followup.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Follow Up</a></li> 
                        <li><a href="{{route('followup.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Follow Up List</a></li>
                        <li><a href="{{route('followup-analysis.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Follow Up Analysis Form</a></li> 
                        <li><a href="{{route('followup-analysis.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Follow Up Analysis</a></li>  
                    </ul>
                </li>
 
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fas fa-file-contract"></i>
                        <span>Negotiation</span>
                    </a> 
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('negotiation.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Negotiations</a></li> 
                        <li><a href="{{route('negotiation.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Negotiation List</a></li>
                        <li><a href="{{route('negotiation-analysis.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Negotiations Analysis Form</a></li> 
                        <li><a href="{{route('negotiation-analysis.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Negotiation Analysis List</a></li>  
                    </ul>
                </li> 

                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fas fa-user-times"></i>
                        <span>Rejection</span>
                    </a>  
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('rejection.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Rejection</a></li> 
                        <li><a href="{{route('rejection.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Rejections</a></li> 
                    </ul>
                </li>  
  
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class=" fas fa-check-double"></i>
                        <span>Sales</span>
                    </a>  
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('salse.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Sales</a></li> 
                        <li><a href="{{route('salse.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Sales</a></li> 
                    </ul>
                </li> 

                 

                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fas fa-user-times"></i>
                        <span>Salse Return</span>
                    </a>  
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('return.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Return</a></li> 
                        <li><a href="{{route('return.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Return List</a></li> 
                    </ul>
                </li> 

                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fas fa-user-times"></i>
                        <span>Salse Transfer</span>
                    </a>  
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('transfer.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Transfer</a></li> 
                        <li><a href="{{route('transfer.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Transfer List</a></li> 
                    </ul>
                </li> 
  
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fas fa-user-times"></i>
                        <span>Deposit</span>
                    </a>  
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('deposit.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Deposit</a></li> 
                        <li><a href="{{route('deposit.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Deposit List</a></li> 
                    </ul>
                </li>  
 
                    <li class="menu-title">Progress</li>  
                    <li>
                        <a href="javascript: void(0);" class="has-arrow ">
                            <i class="mdi mdi-teach"></i>
                            <span>Field Target & Task</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false"> 
                            <li><a href="{{route('target.achive')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Target Achivement</a></li> 
                            <li><a href="{{route('today.target')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Today Task & Target</a></li> 
                            <li><a href="{{route('task.complete')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Task Complete</a></li> 
                            <li><a href="{{route('marketing.field.report')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Marketing Ex. Report</a></li> 
                            <li><a href="{{route('salse.field.report')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Salse Ex Report</a></li> 
                        </ul>
                    </li> 

                    <li>
                        <a href="javascript: void(0);" class="has-arrow ">
                            <i class="mdi mdi-teach"></i>
                            <span>Deposit Target</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false"> 
                            <li><a href="{{route('deposit.target')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Target</a></li> 
                            <li><a href="{{route('deposit.target.asign.list')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Target Asign List</a></li>
                        </ul>
                    </li>  
                    
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
                    <li>
                        <a href="{{route('meeting.index')}}" class="">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Meeting Schedule</span>
                        </a>
                    </li>  
   
                <li class="menu-title">Asign</li>  
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
                </li>   
 
                <li class="menu-title">Report</li> 
                <li>
                    <a href="salse_marketing_target_achivement.html" class="">
                        <i class="fas fa-desktop"></i>
                        <span>S&M Achivement</span>
                    </a>
                </li> 

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

                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-chart-bar"></i>
                        <span>FL Commission</span>
                    </a> 
                    <ul class="sub-menu" aria-expanded="false">  
                        <li><a href="{{route('rsa.co.ordinator')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>RSA & Co-Ordinator</a></li> 
                    </ul>
                </li> 
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-chart-bar"></i>
                        <span>DT Achivement</span>
                    </a> 
                    <ul class="sub-menu" aria-expanded="false"> 
                        <li><a href="{{route('dt.achivement')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Monthly T&A</a></li>
                        <li><a href="{{route('dt.achivement')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Bank Day Wise T&A</a></li> 
                        <li><a href="{{route('daily.deposit')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Daily Deposit</a></li> 
                        {{-- <li><a href="{{route('deposit.report')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Deposit Report</a></li>  --}}
                        {{-- <li><a href="{{route('weekly.deposit')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Weekly Report</a></li>  --}}
                    </ul>
                </li>  
                
                <li>
                    <a href="{{route('due.report')}}" class="">
                        <i class="fas fa-desktop"></i>
                        <span>Due & Over Due</span>
                    </a>
                </li> 

                <li>
                    <a href="{{route('floor.wise.sold.report')}}" class="">
                        <i class="fas fa-desktop"></i>
                        <span>Sold & Unsold Report</span>
                    </a>
                </li>  
  
                <li class="menu-title">Setting</li>  
                <li>
                    <a href="{{route('profession.index')}}" class="">
                        <i class="fas fa-desktop"></i>
                        <span>Profession</span>
                    </a>
                </li> 

                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-chart-bar"></i>
                        <span>Location</span>
                    </a> 
                    <ul class="sub-menu" aria-expanded="false"> 
                        <li><a href="{{route('union.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Union</a></li> 
                        <li><a href="{{route('village.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Village</a></li> 
                        <li><a href="{{route('village.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Zone</a></li> 
                        <li><a href="{{route('village.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Area</a></li> 
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-chart-bar"></i>
                        <span>Product</span>
                    </a> 
                    <ul class="sub-menu" aria-expanded="false"> 
                        <li><a href="{{route('unit.type')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Unit & Down Payment</a></li> 
                        <li><a href="{{route('unit.category')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Unit Category</a></li> 
                    </ul>
                </li>

                <li>
                    <a href="{{route('training.index')}}" class="">
                        <i class="fas fa-desktop"></i>
                        <span>Training</span>
                    </a>
                </li> 

                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-chart-bar"></i>
                        <span>Position & Permission</span>
                    </a> 
                    <ul class="sub-menu" aria-expanded="false"> 
                        <li><a href="{{route('designation.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Employee Position</a></li> 
                        <li><a href="{{route('permission.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Permission</a></li> 
                    </ul>
                </li> 

                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-chart-bar"></i>
                        <span>Commission</span>
                    </a> 
                    <ul class="sub-menu" aria-expanded="false"> 
                        <li><a href="{{route('comission.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Commission</a></li> 
                        <li><a href="{{route('special-comission.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Special Commission</a></li> 
                        <li><a href="{{route('commission-deducted-setting.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Commission Deducation</a></li> 
                    </ul>
                </li>
 

                <li>
                    <a href="{{route('bank.index')}}" class="">
                        <i class="fas fa-desktop"></i>
                        <span>Bank</span>
                    </a>
                </li>  
            </ul>
        </div> 
    </div>
</div>