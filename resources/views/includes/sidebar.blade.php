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
                @if (in_array($user, ['5']))
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
                @endif 


                @if (in_array($user, ['5','4']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow ">
                            <i class="fas fa-network-wired"></i>
                            <span>Product</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('product.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Create Product</a></li> 
                            <li><a href="{{route('product.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Products</a></li>                         
                        </ul>
                    </li> 
                @endif 

                @if (in_array($user, ['1','2','3','4','5']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow ">
                            <i class="fas fa-network-wired"></i>
                            <span>FL Recruitment</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('freelancer.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Join Freelancer</a></li> 
                            <li><a href="{{route('freelancer.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Freelancer List</a></li> 
                        </ul>
                    </li> 
                @endif 

                @if (in_array($user, ['1','3','4','5']))
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-handshake"></i>
                        <span>Customers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('customer.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Customer Entry</a></li> 
                        <li><a href="{{route('customer.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Customer List</a></li> 
                    </ul>
                </li> 
                @endif

                @if (in_array($user, ['1','3','4','5']))
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
                @endif 

                @if (in_array($user, ['1','3','4','5']))
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
                @endif  
                
                @if (in_array($user, ['1','3','4','5']))
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fas fa-people-arrows"></i>
                        <span>Leads</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('lead.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Leads</a></li> 
                        <li><a href="{{route('lead.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Leads</a></li> 
                    </ul>
                </li>
                @endif

                @if (in_array($user, ['1','2','3','4','5']))
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-google-analytics"></i>
                        <span>Lead Analysis</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('lead-analysis.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Lead Analysis</a></li> 
                        <li><a href="{{route('lead-analysis.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Lead Analyses</a></li> 
                    </ul>
                </li>
                @endif
                 
                @if (in_array($user, ['2','3','4','5']))
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-teach"></i>
                        <span>Presentation</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('presentation.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Presentation</a></li> 
                        <li><a href="{{route('presentation.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Presentations</a></li> 
                    </ul>
                </li>
                @endif 

                @if (in_array($user, ['2','3','4','5']))
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-car"></i>
                        <span>Visit Analysis</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('presentation_analysis.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Visit Analysis</a></li> 
                        <li><a href="{{route('presentation_analysis.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Visit Analyses</a></li> 
                    </ul>
                </li> 
                @endif

                @if (in_array($user, ['2','3','4','5']))
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-human-greeting"></i>
                        <span>Follow Up</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('followup.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Follow Up</a></li> 
                        <li><a href="{{route('followup.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Follow Ups</a></li> 
                    </ul>
                </li>
                @endif

                @if (in_array($user, ['2','3','4','5']))
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-google-analytics"></i>
                        <span>Follow Up Analysis</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('followup-analysis.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Analyses</a></li> 
                        <li><a href="{{route('followup-analysis.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Follow Up Analyses</a></li> 
                    </ul>
                </li>
                @endif

                @if (in_array($user, ['2','3','4','5']))
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fas fa-file-contract"></i>
                        <span>Negotiation</span>
                    </a> 
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('negotiation.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Entry Negotiations</a></li> 
                        <li><a href="{{route('negotiation.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Negotiations</a></li> 
                    </ul>
                </li>
                @endif

                @if (in_array($user, ['2','3','4','5']))
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-chart-bar"></i>
                        <span>Negotiation Analysis</span>
                    </a> 
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('negotiation-analysis.create')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Entry Analysis</a></li> 
                        <li><a href="{{route('negotiation-analysis.index')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Negotiation Analyses</a></li> 
                    </ul>
                </li>
                @endif
                
                @if (in_array($user, ['2','3','4','5']))
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
                @endif

                @if (in_array($user, ['2','3','4','5']))
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
                @endif 
                @if (in_array($user, ['1','2','3','4'])) 

                    <li class="menu-title">Progress</li> 
                    <li>
                        <a href="{{route('target.achive')}}" class="">
                            <i class="fas fa-crown"></i>
                            <span>Target Achivement</span>
                        </a>
                    </li> 
                    
                    <li>
                        <a href="{{route('task.complete')}}" class="">
                            <i class=" fas fa-check"></i>
                            <span>Task Complete</span>
                        </a>
                    </li> 

                    <li>
                        <a href="{{route('today.target')}}" class="">
                            <i class="fas fa-walking"></i>
                            <span>Today Task & Target</span>
                        </a>
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
                @endif

                @if (in_array($user, ['2','3','4','5']))
                <li class="menu-title">Report</li> 
                <li>
                    <a href="salse_marketing_target_achivement.html" class="">
                        <i class="fas fa-desktop"></i>
                        <span>S&M Achivement</span>
                    </a>
                </li> 

                <li>
                    <a href="{{route('salse.commission.summery')}}" class="">
                        <i class="fas fa-desktop"></i>
                        <span>Salse Comission</span>
                    </a>
                </li>  
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-chart-bar"></i>
                        <span>Target Sheet</span>
                    </a> 
                    <ul class="sub-menu" aria-expanded="false"> 
                        <li><a href="{{route('target.sheet')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Sub Total</a></li> 
                         
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-chart-bar"></i>
                        <span>Deposit Report</span>
                    </a> 
                    <ul class="sub-menu" aria-expanded="false"> 
                        <li><a href="{{route('deposit.report.salse.executive')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Salse Executive</a></li> 
                        <li><a href="{{route('deposit.report.asm.dsm')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>ASM & DSM</a></li> 
                        <li><a href="{{route('deposit.report.area.incharge')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Area Incharge</a></li>
                        <li><a href="{{route('deposit.report.area.incharge')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Ast. Zonal Manager</a></li>   
                        <li><a href="{{route('deposit.report.area.incharge')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Zonal Manager</a></li>
                        <li><a href="{{route('deposit.report.area.incharge')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Senior Zonal Manager</a></li>
                        <li><a href="{{route('deposit.report.area.incharge')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Zonal Co Ordinator</a></li>
                        <li><a href="{{route('deposit.report.area.incharge')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Regional Manager</a></li>
                        <li><a href="{{route('deposit.report.area.incharge')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>Sales Manager</a></li>
                        <li><a href="{{route('deposit.report.area.incharge')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>A.G.M</a></li>
                        <li><a href="{{route('deposit.report.area.incharge')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>D.G.M</a></li>
                        <li><a href="{{route('deposit.report.area.incharge')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>G.M</a></li>
                    </ul>
                </li>

                @endif
 
                @if (in_array($user, ['5'])) 
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
                    </ul>
                </li>

                <li>
                    <a href="{{route('training.index')}}" class="">
                        <i class="fas fa-desktop"></i>
                        <span>Training</span>
                    </a>
                </li> 

                <li>
                    <a href="{{route('employee-position.index')}}" class="">
                        <i class="fas fa-desktop"></i>
                        <span>Employee Position</span>
                    </a>
                </li> 

                <li>
                    <a href="{{route('special-comission.index')}}" class="">
                        <i class="fas fa-desktop"></i>
                        <span>Special Comission</span>
                    </a>
                </li>
                @endif 
            </ul>
        </div> 
    </div>
</div>