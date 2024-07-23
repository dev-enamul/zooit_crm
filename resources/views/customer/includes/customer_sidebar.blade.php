
    <div class="card border mb-0"> 
        <div class="card-header">
            <div class="text-center w-100">
                <img class="w-100 mb-3" src="{{@$customer->user->image()}}" alt="">
                <h5 class="mb-0">{{@$customer->user->name}}</h5>
                <p>{{@$customer->profession->name}}</p>
            </div>
        </div>
        <div class="card-body">
            <div class="list-group"> 
                @foreach ($customer->user->customer as $single_customer)
                <a href="{{route('customer.profile',encrypt($single_customer->id))}}" class="list-group-item list-group-item-action {{$customer->id==$single_customer->id?"active":""}}">{{$single_customer->customer_id}}</a> 
                @endforeach
               
            </div>
        </div>
    </div> 