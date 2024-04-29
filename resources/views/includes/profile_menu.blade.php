<div class="card border mb-0"> 
    <div class="card-header">
        <div class="text-center w-100">
            <img class="w-100 mb-3" src="{{$user->image()}}" alt="">
            <h5 class="mb-0">{{$user->name}}</h5>
            @if ($user->user_type==1)
                <p class="m-0">{{@$user->employee->designation->title}}</p>
            @else  
                <p class="m-0">{{@$user->freelancer->designation->title}}</p>
            @endif  
            <p>{{@$user->userAddress->area->name}}</p>
        </div>
    </div>
    <div class="card-body">
        <div class="list-group"> 
            <a href="{{route('profile',encrypt($user->id))}}" class="list-group-item list-group-item-action {{Route::is('profile')?"active":""}}">About </a>
            @if ($user->user_type==1)
                <a href="{{route('profile.hierarchy',encrypt($user->id))}}" class="list-group-item list-group-item-action {{Route::is('profile.hierarchy')?"active":""}} ">Hierarchy</a> 
            @endif 
            @if ($user->user_type==2)  
                <a href="{{route('freelancer.join.process',encrypt($user->id))}}" class="list-group-item list-group-item-action {{Route::is('freelancer.join.process')?"active":""}}"> Join Process</a>
            @endif  
            {{-- <a href="{{route('freelancer.book')}}" class="list-group-item list-group-item-action {{Route::is('freelancer.book')?"active":""}}">Book</a> --}}
            <a href="{{route('profile.target.achive',encrypt($user->id))}}" class="list-group-item list-group-item-action {{Route::is('profile.target.achive')?"active":""}}">Target Achive</a>
            <a href="{{route('profile.wallet',encrypt($user->id))}}" class="list-group-item list-group-item-action {{Route::is('profile.wallet')?"active":""}}">Wallet</a> 
            <a href="{{route('profile.document',encrypt($user->id))}}" class="list-group-item list-group-item-action {{Route::is('profile.document')?"active":""}}">Document</a> 
        </div>
    </div>
</div>