@extends('user.template.layout')
@section('title')
Home
@stop
@section('page-specific-css')
@stop
@section('content')
    <section class="">
        <div class="container breadcumb">
            <div class="row">
                <div class="col-sm-3 hidden-xs">
                    <h1 class="mh-title">My Account</h1>
                </div>
                <div class="breadcrumb-w col-sm-9">
                    <span class="hidden-xs">You are here:</span>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <span>Card Information</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="account-content parten-bg">
        <div class="container">
            <!--Account top banner -->
            <div class="row">
                <div class="col-md-12 cart-banner-top hidden-xs">
                    <a href="#" title="cart top banner">
                        <img src="{{asset('images/banner/cart/top-banner.jpg')}}" alt="Cart top banner" />
                    </a>
                </div>
            </div><!--Account top banner : End-->
            <div class="row acc-dashboard">
                <!--Account Sidebar: End-->
                @include('user._partial.user-nav')
                <!--Account Sidebar: End-->
                <!--Account main content : Begin -->

                <section class="account-main col-md-9 col-sm-8 col-xs-12">
                    <h3 class="acc-title lg">Card Information</h3>
                    <br class="form-edit-info">
                        <button style="margin-bottom:6px;" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#add_card">Add New</button>

                       <!--Add modal for new card entry -->
                    <!-- Modal -->
                    <div class="modal fade" id="add_card" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <button type="button" class="close"
                                            data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        Add New Card
                                    </h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">

                                    {!! Form::open(array('method'=>'post','route'=>'user.card-information','files'=>'true','id'=>'card_info_form')) !!}
                                        <div class="form-group">
                                            <label for="holder_name">Holder Name</label>
                                            <input type="text" class="form-control" required id="holder_name" name="holder_name" />
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Type</label>
                                                <select class="form-control" id="type" name="type">
                                                    <option value="VISA"> VISA CARD </option>
                                                    <option value="MASTER"> MASTER CARD </option>
                                                </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="account_no">Account No.</label>
                                            <input type="text" class="form-control" required id="account_no" name="account_no"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="account_no">Expire Date</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" id="expire_date" name="expire_date">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="default" name="default" value="1"/> Make me Default
                                            </label>
                                        </div>
                                        <div style="text-align: right;">
                                            <button type="submit" class="btn btn-success">Save</button>

                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                  <th>Default</th>
                                  <th>Holder Name</th>
                                  <th>Type</th>
                                  <th>Account No.</th>
                                  <th>Expired</th>
                                  <th>Action</th>
                              </tr>
                            </thead>
                            @if(!empty($userCards))
                            <tbody>
                            @foreach($userCards as $data)
                                 <tr data-default="{{$data->default}}" data-holder_name="{{$data->holder_name}}" data-url="{{route('user.card-information.update',$data->id)}}"
                                         data-type="{{$data->type}}" data-account_no="{{$data->account_no}}" data-expire_date="{{$data->expire_date}}"
                                          data-id="{{$data->id}}">

                                     <td><input type="checkbox"  name="default" {{($data->default==1)?'checked':''}} onclick="return false;"/></td>
                                     <td>{{$data->holder_name}}</td>
                                     <td>{{$data->type}}</td>
                                     <td>{{$data->account_no}}</td>
                                     <td>{{$data->expire_date}}</td>
                                     <td style="text-align: center;">
                                         <a class="edit" href="javascript:void(0)" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                                         <a class="del" data-id={{$data->id}} data-deleteurl="{{route('user.card-information.delete')}}" href="javascript:void(0)" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                                     </td>

                                 </tr>
                              @endforeach
                            </tbody>
                             @endif
                        </table>
                </section>
            </div>
        </div>
    </section><!-- Cart main content : End -->
@stop
@section('page-specific-js')
            <script>
                $(function () {
                   $("#card_info").addClass('active');
                    $('.date').datepicker({
                        autoclose: true,
                        format: "yyyy-mm-dd",
                    });

                // load modal with data dynamically when edit is clicked
                    $(document).on('click','.edit',function(){
                        console.log('click');
                        var id = $(this).closest('tr').data('id');
                        var is_default = $(this).closest('tr').data('default');
                        var holder_name = $(this).closest('tr').data('holder_name');
                        console.log(holder_name);
                        var type = $(this).closest('tr').data('type');
                        var account_no = $(this).closest('tr').data('account_no');
                        var expire_date = $(this).closest('tr').data('expire_date');
                        var url = $(this).closest('tr').data('url');
                        console.log(url);
                       // console.log(holder_name);
                        // assigned modal form value using id;
                        $("#holder_name").val(holder_name);
                        $("#type").val(type);
                        $("#account_no").val(account_no);
                        $("#expire_date").val(expire_date);

                        if(is_default==1){
                           $("#default").attr("Checked","checked");
                        }
                        // change form action to update
                        $("#card_info_form").attr('action', url);
                        // show modal
                        $('#add_card').modal('show');
                        //$('input').val('');
                    });

                    // on modal close empty input fields
                    $('#add_card').on('hidden.bs.modal', function (e) {
                        //console.log('modal close');
                        $('input').val('');

                    })

                    // delete card info
                    $(document).on('click','.del',function(){
                        var url = $(this).data('deleteurl');
                        var id = $(this).data('id');

                        console.log(url);
                         var $selTr = $(this).closest('tr');
                        // ajax call to delete
                        var ajaxCall = $.ajax({
                            url:url,
                            method: 'post',
                            data:{
                                'id':id,
                                '_token': '{{ csrf_token() }}'
                            },
                        });
                        ajaxCall.done(function() {
                           $selTr.remove();
                           alert('Deleted');
                        });

                        //location.href = url;
                    });
                })
            </script>
@stop
