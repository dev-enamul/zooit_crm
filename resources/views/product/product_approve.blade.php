@extends('layouts.dashboard')
@section('title','Product Create')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Product Approve</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Product Approve</li>
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
                           <div class="d-flex justify-content-between"> 
                                <div class="mb-1">
                                    <input class="form-check-input" type="checkbox" value="" id="selectAll" > 
                                    <label for="selectAll">Check All</label>
                                </div> 

                                <div class="mb-1">
                                    <button class="btn btn-primary" type="submit">
                                        Approve
                                    </button>
                                </div>
                           </div>
                           
                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="">
                                        <th>Action</th>
                                        <th>S/N</th> 
                                        <th>Name & ID</th>
                                        <th>Address</th>
                                        <th>Flat</th>
                                        <th>Shop</th>
                                        <th>Garage</th> 
                                        <th>Deiuxe/Studio</th> 
                                        <th>Sea/Hall</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                   <tr class="">
                                        <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                                        </td>
                                        <td>1</td>
                                        <td><a href="#">MN Tower</a></td>
                                        <td>Mohammadpur, Dhaka</td>
                                        <td>3/12</td>
                                        <td>4/12</td>
                                        <td>6/12</td>
                                        <td>4/65</td> 
                                        <td>5/12</td>
                                    </tr> 

                                    <tr class="">
                                         <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                                        </td> 
                                        <td>1</td>
                                        <td><a href="#">MN Tower</a></td>
                                        <td>Mohammadpur, Dhaka</td>
                                        <td>3/12</td>
                                        <td>4/12</td>
                                        <td>6/12</td>
                                        <td>4/65</td> 
                                        <td>5/12</td>
                                    </tr> 

                                    <tr class="">
                                         <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                                        </td> 
                                        <td>1</td>
                                        <td><a href="#">MN Tower</a></td>
                                        <td>Mohammadpur, Dhaka</td>
                                        <td>3/12</td>
                                        <td>4/12</td>
                                        <td>6/12</td>
                                        <td>4/65</td> 
                                        <td>5/12</td>
                                    </tr> 

                                    <tr class="">
                                         <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                                         </td>
                                        <td>1</td>
                                        <td><a href="#">MN Tower</a></td>
                                        <td>Mohammadpur, Dhaka</td>
                                        <td>3/12</td>
                                        <td>4/12</td>
                                        <td>6/12</td>
                                        <td>4/65</td> 
                                        <td>5/12</td>
                                    </tr> 

                                    <tr class="">
                                         <td class="text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                                         </td>
                                        <td>1</td>
                                        <td><a href="#">MN Tower</a></td>
                                        <td>Mohammadpur, Dhaka</td>
                                        <td>3/12</td>
                                        <td>4/12</td>
                                        <td>6/12</td>
                                        <td>4/65</td> 
                                        <td>5/12</td>
                                    </tr> 
                                     
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
    $(document).ready(function () { 
        $('#selectAll').click(function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });
</script>
@endsection