@extends('layouts.dashboard')
@section('title','Training Details')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box text-center">
                        <h4 class="mb-sm-0 pb-1">{{$data->category->title}}</h4> 
                        <p class="m-0">{{get_date($data->date)}} <span class="badge badge-label-primary"> {{ date('h:i A', strtotime($data->time)) }} </span></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header card-header-bordered bg-primary">
                            <div class="card-icon text-white"><i class="fa fa-user-tag fs14"></i></div>
                            <h3 class="card-title text-white">Trainer</h3>
                        </div>
                        <div class="card-body">
                            <div class="rich-list rich-list-flush">
                                @foreach ($trainers as $user)
                                    <div class="flex-column align-items-stretch">
                                        <div class="rich-list-item">
                                            <div class="rich-list-prepend">
                                                <div class="avatar avatar-xs">
                                                    <div class=""><img src="{{$user->image()}}" class="avatar-2xs"></div>
                                                </div>
                                            </div>
                                            <div class="rich-list-content">
                                                <h4 class="rich-list-title mb-1">{{$user->name}}</h4>
                                                <p class="rich-list-subtitle mb-0">{{@$user->employee->designation->title}} [{{@$user->user_id}}]</p>
                                            </div>
                                            @if ($user->user_type==1 || $user->user_type==2)
                                                <div class="rich-list-append">
                                                    <a href="{{route('profile',encrypt($user->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                </div> 
                                            @else  
                                                <div class="rich-list-append">
                                                    <a href="{{route('customer.profile',encrypt(@$user->customer[0]->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                </div>
                                            @endif 
                                        </div>
                                    </div> 
                                @endforeach
                               
                            </div>
                        </div>

                        @if ($data->date > date('Y-m-d') && $data->status==0)

                        <div class="card-header card-header-bordered bg-primary">
                            <div class="card-icon text-white"><i class="fa fa-user-tag fs14"></i></div>
                            <h3 class="card-title text-white">Add Employee/Freelanecr</h3>
                        </div>
                        <div class="card-body">
                            <div class="rich-list rich-list-flush">
                                <form action="{{route('training.add.person')}}" method="post">
                                    @csrf
                                    <div class="row">   
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="hidden" name="training_id" value="{{$data->id}}">
                                                <label for="employee" class="form-label">Employee/Freelancer <span class="text-danger">*</span></label>
                                                <select class="select2" multiple name="user_id[]" id="employee" required>
                                                    
                                                </select>
                                                <div class="invalid-feedback">
                                                    This field is required.
                                                </div>
                                            </div>
                                        </div>   
                                    </div> 
                                    <div>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>


                        <div class="card-header card-header-bordered bg-primary">
                            <div class="card-icon text-white"><i class="fa fa-user-tag fs14"></i></div>
                            <h3 class="card-title text-white">Seat Booked</h3>
                        </div>
                        <div class="card-body">
                            <div class="rich-list rich-list-flush">
                                @foreach ($bookeds as $book)
                                    @php
                                        $user = $book->user;
                                    @endphp
                                    <div class="flex-column align-items-stretch">
                                        <div class="rich-list-item">
                                            <div class="rich-list-prepend">
                                                <div class="avatar avatar-xs">
                                                    <div class=""><img src="{{@$user->image()}}" class="avatar-2xs"></div>
                                                </div>
                                            </div>
                                            <div class="rich-list-content">
                                                <h4 class="rich-list-title mb-1">{{@$user->name}}</h4>
                                                <p class="rich-list-subtitle mb-0">{{@$user->employee->designation->title}} [{{$user->user_id}}]</p>
                                            </div>
                                            @if ($user->user_type==1 || $user->user_type==2)
                                                <div class="rich-list-append">
                                                    <a href="{{route('profile',encrypt($user->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                </div> 
                                            @else  
                                                <div class="rich-list-append">
                                                    <a href="{{route('customer.profile',encrypt(@$user->customer[0]->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                </div>
                                            @endif 
                                        </div>
                                    </div> 
                                @endforeach
                            </div>
                        </div>
                        @else 
                            <div class="card-header card-header-bordered bg-primary">
                                <div class="card-icon text-white"><i class="fa fa-user-tag fs14"></i></div>
                                <h3 class="card-title text-white">Present</h3>
                            </div>
                            <div class="card-body">
                                <div class="rich-list rich-list-flush">
                                    @foreach ($present as $user)
                                    @php
                                        $user = $user->user;
                                    @endphp
                                        <div class="flex-column align-items-stretch">
                                            <div class="rich-list-item">
                                                <div class="rich-list-prepend">
                                                    <div class="avatar avatar-xs">
                                                        <div class=""><img src="{{@$user->image()}}" class="avatar-2xs"></div>
                                                    </div>
                                                </div>
                                                <div class="rich-list-content">
                                                    <h4 class="rich-list-title mb-1">{{@$user->name}}</h4>
                                                    <p class="rich-list-subtitle mb-0">{{@$user->employee->designation->title}} [{{$user->user_id}}]</p>
                                                </div>
                                                @if ($user->user_type==1 || $user->user_type==2)
                                                    <div class="rich-list-append">
                                                        <a href="{{route('profile',encrypt($user->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                    </div> 
                                                @else  
                                                    <div class="rich-list-append">
                                                        <a href="{{route('customer.profile',encrypt(@$user->customer[0]->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                    </div>
                                                @endif 
                                            </div>
                                        </div> 
                                    @endforeach
                                </div>
                            </div> 


                            <div class="card-header card-header-bordered bg-primary">
                                <div class="card-icon text-white"><i class="fa fa-user-tag fs14"></i></div>
                                <h3 class="card-title text-white">Absent</h3>
                            </div>
                            <div class="card-body">
                                <div class="rich-list rich-list-flush">
                                    @foreach ($absent as $user)
                                    @php
                                        $user = $user->user;
                                    @endphp
                                        <div class="flex-column align-items-stretch">
                                            <div class="rich-list-item">
                                                <div class="rich-list-prepend">
                                                    <div class="avatar avatar-xs">
                                                        <div class=""><img src="{{$user->image()}}" class="avatar-2xs"></div>
                                                    </div>
                                                </div>
                                                <div class="rich-list-content">
                                                    <h4 class="rich-list-title mb-1">{{$user->name}}</h4>
                                                    <p class="rich-list-subtitle mb-0">{{@$user->employee->designation->title}} [{{$user->user_id}}]</p>
                                                </div>
                                                @if ($user->user_type==1 || $user->user_type==2)
                                                    <div class="rich-list-append">
                                                        <a href="{{route('profile',encrypt($user->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                    </div> 
                                                @else  
                                                    <div class="rich-list-append">
                                                        <a href="{{route('customer.profile',encrypt(@$user->customer[0]->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                    </div>
                                                @endif 
                                            </div>
                                        </div> 
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="card-icon text-white"><i class="mdi mdi-view-agenda fs14"></i></div>
                            <h3 class="card-title text-white"> Agenda</h3>
                        </div>
                        <div class="card-body"> 
                            {{$data->agenda}}
                            {{-- <h5>Welcome and Introduction (15 minutes)</h5>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-dot text-primary"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0">Greet participants and set a positive tone for the session.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-dot text-secondary"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0">Introduce the importance of effective communication in the housing industry.</p>
                                    </div>
                                </div> 
                            </div>
    
                            <h5>Icebreaker Activity: "Two Truths and a Lie" (20 minutes)</h5>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-dot text-primary"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0">Encourage team members to share interesting facts about themselves.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-dot text-secondary"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0">Foster a relaxed atmosphere for open communication.</p>
                                    </div>
                                </div> 
                            </div>
    
                            <h5>Understanding Communication Styles (30 minutes)</h5>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-dot text-primary"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0">Presentation on different communication styles.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-dot text-secondary"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0">Group discussion on recognizing and adapting to various communication preferences</p>
                                    </div>
                                </div> 
                            </div>
    
                            <h5>Active Listening Techniques (20 minutes)</h5>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-dot text-primary"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0">Importance of active listening in effective communication.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-dot text-secondary"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0">Interactive exercises to practice active listening skills.</p>
                                    </div>
                                </div> 
                            </div>

                            <h5>Break (10 minutes)</h5>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-dot text-secondary"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0">Break (10 minutes)</p>
                                    </div>
                                </div> 
                            </div>  --}}
                        </div>
                    </div> 
                </div>
            </div> 
        </div>  
    </div>

 @include('includes.footer')

</div>
@endsection 

@section('script') 
    <script>
        $(document).ready(function() { 
            $('#employee').select2({
                placeholder: "Select Employee",
                allowClear: true,
                ajax: {
                    url: '{{ route('select2.employee.freelancer') }}',
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            term: params.term
                        }
                        return query;
                    }
                }
            });
        }); 
    </script> 
@endsection