@extends('admin.template.layout')
@section('title')
    Category Print Info
@stop
@section('page-specific-css')
    <style>
        .extra-value-field input{
            margin-bottom: 25px;
        }
        .well-label{
            padding-bottom: 15px;
            border-bottom: 1px dotted #eee;
        }
    </style>
@stop
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Details of</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            {{--<ol class="breadcrumb">--}}
            {{--<li><a href="#">Dashboard</a></li>--}}
            {{--</ol>--}}
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class=""><a  href="{{route('admin.category.upload-info',$id)}}" ><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Upload Info</span></a></li>
                    <li role="presentation" class="active"><a ><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Print Info</span></a></li>
                    <li role="presentation" class=""><a href="{{route('admin.category.press-info',$id)}}" ><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Press Info</span></a></li>
                    <li role="presentation" class=""><a href=""{{route('admin.category.price-map',$id)}}" " ><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Price Map</span></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 well">
                                <h3 class="text-center well-label"> Added Field </h3>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Label</th>
                                            <th>Field Type</th>
                                            <th>Placeholder</th>
                                            <th>Values</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($data))
                                            @foreach($data as $item)
                                                <tr>
                                                    <td> {{$item->label}} </td>
                                                    <td> {{$item->field_type}} </td>
                                                    <td> {{$item->placeholder}} </td>
                                                    <td>
                                                        @if(!empty($item->values))
                                                            @foreach(json_decode($item->values) as $value)
                                                                {{$value.' , '}}
                                                            @endforeach
                                                        @else
                                                            Null
                                                        @endif
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <a class="btn btn-info btn-circle edit-button" data-item="{{$item}}"><i class="fa fa-edit" data-toggle="tooltip"  data-original-title="Edit"></i></a>
                                                        <a class="btn btn-danger btn-circle " href="{{route('admin.category.print-info.delete',$item->id)}}" data-toggle="tooltip" data-original-title="delete">
                                                            <i class="fa fa-close "></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 well">
                                <form class="" method="post" action="{{route('admin.category.print-info',[$id])}}">
                                    {!! Form::token() !!}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="email">Label: </label>
                                            <input type="text" class="form-control" id="label" name="label">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="pwd">Field Type: </label>
                                            <select id="field-type" class="field-type form-control" name="field_type">
                                                <option value="" selected hidden>Select field type</option>
                                                <option value="text">Text</option>
                                                <option value="number">Number</option>
                                                <option value="file">File</option>
                                                <option value="checkbox">CheckBox</option>
                                                <option value="radio">Radio Button</option>
                                                <option value="select">Select Field</option>
                                                <option value="textarea">Text Box</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="email">Placeholder: </label>
                                            <input type="text" class="form-control" id="label" name="placeholder">
                                        </div>
                                    </div>
                                    <div class="col-md-3 value-block">
                                        <div class="row value-field hidden">
                                            <div class="form-group col-md-8">
                                                <label>Values</label>
                                                <input type="text" class="form-control" name="values[0]">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" style="margin-top: 28px;">
                                                    <button id="add-value-field" type="button" class="add-value-field btn btn-success btn-circle " data-child="0"><i class="fa fa-plus"></i></button> Add
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row extra-value-field">

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="edit_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel">Edit</h4> </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop
@section('page-specific-js')
    <script>
        $(document).ready(function () {
            var extraValueFieldNo = 0;
            $('.field-type').on('change',function () {
                extraValueFieldNo = 0;
                $('.extra-value-field').empty();

                var fieldValue = $(this).val();
                var requireValueFieldForInputType = ['select','radio','checkbox'];
                console.log($.inArray(fieldValue,requireValueFieldForInputType));
                if($.inArray(fieldValue,requireValueFieldForInputType)>-1){
                    $('.value-field').removeClass('hidden');
                }else{
                    $('.value-field').removeClass('hidden').addClass('hidden');
                }
            });

            $(document).on('change','.edit-field-type',function () {
                extraValueFieldNo = 0;
                $('.extra-value-field').empty();

                var fieldValue = $(this).val();
                var requireValueFieldForInputType = ['select','radio','checkbox'];
                console.log($.inArray(fieldValue,requireValueFieldForInputType));
                if($.inArray(fieldValue,requireValueFieldForInputType)>-1){
                    $(this).closest('form').find('.value-field').removeClass('hidden');
                }else{
                    $(this).closest('form').find('.value-field').removeClass('hidden').addClass('hidden');
                }
            });


            $(document).on('click','.edit-button',function () {
                var item = $(this).data('item');
                var url = '{!! route('admin.category.print-info.update',[':categoryId',':uploadInfoId']) !!}';
                url = url.replace(':categoryId',item.category_id);
                url= url.replace(':uploadInfoId',item.id);
                var editForm = '<form method="post" action="'+url+'">'+'{!! Form::token() !!}'+'<div class="row">';
                //label
                editForm += '<div class="col-md-3">' +
                    '<div class="form-group">' +
                    '<label for="email">Label: </label>' +
                    '<input type="text" class="form-control" id="edit-label" name="label" value="'+item.label+'">' +
                    '</div>'+
                    '</div>';
                //field_type
                editForm+='<div class="col-md-3">' +
                    '<div class="form-group">' +
                    '<label for="pwd">Field Type: </label>' +
                    '<select class="edit-field-type form-control" name="field_type">' +
                    '<option value="" hidden>Select field type</option>' +
                    '<option value="text" '+(item.field_type=="text"?"selected":"")+'>Text</option>' +
                    '<option value="number" '+(item.field_type=="number"?"selected":"")+'>Number</option>' +
                    '<option value="file" '+(item.field_type=="file"?"selected":"")+'>File</option>' +
                    '<option value="checkbox" '+(item.field_type=="checkbox"?"selected":"")+'>CheckBox</option>' +
                    '<option value="radio" '+(item.field_type=="radio"?"selected":"")+'>Radio Button</option>' +
                    '<option value="select" '+(item.field_type=="select"?"selected":"")+'>Select Field</option>' +
                    '</select>' +
                    '</div>' +
                    '</div>';
                //placeholder
                editForm+='<div class="col-md-3">' +
                    '<div class="form-group">' +
                    '<label for="email">Placeholder: </label>' +
                    '<input type="text" class="form-control" id="edit-placeholder" name="placeholder" value="'+item.placeholder+'">' +
                    '</div>' +
                    '</div>';
                //value block
                var values = JSON.parse(item.values);
                console.log(values);
                editForm+='<div class="col-md-3 value-block">' +
                    '<div class="row value-field '+((values.length>0)?"":"hidden")+'">';

                if(values.length>0){
                    for(var i=0;i<values.length;i++){
                        if(i==0){
                            editForm+='<div class="form-group col-md-8">' +
                                '<label>Values</label>' +
                                '<input type="text" class="form-control" name="values[0]" value="'+values[i]+'">' +
                                '</div>' +
                                '<div class="col-md-4">' +
                                '<div class="form-group" style="margin-top: 28px;">' +
                                '<button id="" type="button" class="btn btn-success btn-circle add-value-field" data-child="'+(values.length-1)+'"><i class="fa fa-plus"></i></button> Add' +
                                '</div>' +
                                '</div>'
                        }else{
                            editForm+='<div class="row">' +
                                '<div class="form-group col-md-8">' +
                                '<input type="text" class="form-control" name="values['+i+']" value="'+values[i]+'">' +
                                '</div>' +
                                '</div>'
                        }
                    }
                }else{
                    editForm +='<div class="form-group col-md-8">' +
                        '<label>Values</label>' +
                        '<input type="text" class="form-control" name="values[0]">' +
                        '</div>' +
                        '<div class="col-md-4">' +
                        '<div class="form-group" style="margin-top: 28px;">' +
                        '<button id="" type="button" class="btn btn-success btn-circle add-value-field" data-child="0"><i class="fa fa-plus"></i></button> Add' +
                        '</div>' +
                        '</div>';
                }

                editForm=editForm+'</div>' +
                    '<div class="row extra-value-field">' +
                    '</div>' +
                    '</div>';
                //button
                editForm=editForm+'<div class="col-md-12">' +
                    '<button type="submit" class="btn btn-default">Submit</button>' +
                    '</div>';
                editForm +='</div></form>';
                $('.modal-body').html(editForm);
                $('#edit_modal').modal('show');
            });

            $(document).on('click','.add-value-field',function(){
                extraValueFieldNo = $(this).data('child') + 1;
                $(this).data('child',extraValueFieldNo);
                var extraValueFieldHtml = '<div class="col-md-8">'+
                    '<input type="text" class="form-control" name="values['+extraValueFieldNo+']">'+
                    '</div>';
                $(this).closest('.value-block').find('.extra-value-field').append(extraValueFieldHtml);

            });
        });
    </script>
@stop