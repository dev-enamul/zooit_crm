@extends('layouts.dashboard')
@section('title',"Wallet")  
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
           
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('includes.profile_menu')
                </div> 
                <div class="col-md-9">  
                    <div class="card">
                        <div class="card-body">
                            <form class="form" action="{{route('profile.document.store')}}" enctype="multipart/form-data" method="post">
                                @csrf 
                                
                                <div class="row">
                                    <div class="col-md-6 mt-3"> 
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <label for="tin_number" class="form-label">File Title</label>
                                        <input type="text" placeholder="Enter file title" class="form-control" name="title" id="">
                                    </div> 
                                    <div class="col-md-6 mt-3">
                                        <label for="tin_number" class="form-label">File</label>
                                        <input type="file" class="form-control" name="file" id="">
                                    </div> 
                                    <div class="col-md-2 mt-3"> 
                                        <button type="submit" class="btn btn-secondary">Add File</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 
                    <div class="accordion" id="accordionExample-Pricing">
                        @foreach ($datas as $data)
                            @php
                                $filePath = 'storage/' . $data->file;
                                $fileExtension = pathinfo(storage_path('app/public/' . $data->file), PATHINFO_EXTENSION);
                                $isImage = in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']);
                            @endphp
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-Pricing-{{ $loop->index }}" aria-expanded="true" aria-controls="collapseOne-Pricing-{{ $loop->index }}">
                                        <i class="fas {{ $isImage ? 'fa-file-image' : 'fa-file' }} text-primary"></i>  &nbsp; {{$data->title}}  
                                    </button>
                                </h2>
                                <div id="collapseOne-Pricing-{{ $loop->index }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample-Pricing">
                                    <div class="accordion-body">
                                        @if ($isImage)
                                            <img src="{{ asset($filePath) }}" alt="{{$data->title}}" style="width: 100%;">
                                        @elseif ($fileExtension === 'pdf')
                                            <embed
                                                src="{{ asset($filePath) }}"
                                                frameBorder="0"
                                                scrolling="auto"
                                                width="100%"
                                                height="600px"
                                            ></embed>
                                        @else
                                            <p>Unsupported file type.</p>
                                        @endif
                    
                                        <div style="margin-top: 10px;">
                                            <a href="{{ asset($filePath) }}" download class="btn btn-primary"> 
                                                <i class="fas fa-download"></i> Download {{$data->title}}
                                            </a> 
                                            <button type="button" class="btn btn-danger" onclick="deleteItem('{{ route('profile.document.delete', encrypt($data->id)) }}')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                </div>
            </div> 
        </div> 
    </div>  

    @include('includes.footer')
</div> 
@endsection 
 
@section('script')
    
@endsection