<div class="card border mb-0"> 
    <div class="card-header">
        <div class="text-center w-100">
            <img class="w-100 mb-3" src="{{asset('assets/images/users/avatar-6.png')}}" alt="">
            <h5 class="mb-0">Md Enamul Haque</h5>
            <p>Software Engineer</p>
        </div>
    </div>
    <div class="card-body">
        <div class="list-group">
            <a href="{{route('freelancer.profile')}}" class="list-group-item list-group-item-action {{Route::is('freelancer.profile')?"active":""}}  ">Home</a> 
            <a href="{{route('freelancer.hierarchy')}}" class="list-group-item list-group-item-action {{Route::is('freelancer.hierarchy')?"active":""}}">Hierarchy </a>
            <a href="{{route('freelancer.book')}}" class="list-group-item list-group-item-action {{Route::is('freelancer.book')?"active":""}}">Book</a>
            <a href="{{route('freelancer.field.work')}}" class="list-group-item list-group-item-action {{Route::is('freelancer.field.work')?"active":""}}">Field Work</a>
            <a href="{{route('freelancer.wallet')}}" class="list-group-item list-group-item-action {{Route::is('freelancer.wallet')?"active":""}}">Wallet</a>
            <a href="{{route('freelancer.salse')}}"  class="list-group-item list-group-item-action {{Route::is('freelancer.salse')?"active":""}}">Salse</a>
        </div>
    </div>
</div>