@extends('layouts.dashboard')
@section('title','Product Sold & Unsold')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{$product->name}}</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Product Sold & Unsold</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

         

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                            <table id="datatable" class="text-center table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                 <tbody> 
                                    @for ($i = $product->total_floor; $i >= 1; $i--)
                                    <tr class=""> 
                                        <td><b>Floor-{{$i}}</b></td>
                                        @php 
                                            $units = $product->units->where('floor',$i);
                                        @endphp  

                                        @foreach ($units as $unit) 
                                            @php
                                            if($unit->sold_status==0){  
                                                $sold = ''; 
                                            }elseif ($unit->sold_status==1) { 
                                                $sold = 'bg-danger';
                                            }elseif($unit->sold_status==2){
                                                $sold = 'bg-primary';
                                            }else{
                                                $sold = 'bg-danger';
                                            }
                                            @endphp   
                                            <td class="{{$sold}}">
                                                {{$unit->unit->title}} <br>
                                                Type {{$unit->unitCategory->title}} 
                                            </td>
                                        @endforeach 
                                    </tr>  
                                    @endfor 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Zoom IT.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="http://Zoom IT.in/" target="_blank" class="text-muted">Zoom IT</a>
                    </div>
                </div>
            </div>
        </div>
    </footer> 
</div>
@endsection  

@section('script') 
<script>
    var title = $('.page-title-box').find('h4').text();
    var Period = $('.page-title-box').find('p').text(); 
</script>
    {{-- @include('includes.data_table') --}}
    
@endsection
