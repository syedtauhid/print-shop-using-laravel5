@extends('admin.template.layout')
@section('title')
    Category
@stop
@section('page-specific-css')
    <style>
        .tree {
            min-height:20px;
            padding:19px;
            padding-left: 0;
            margin-bottom:20px;
            background-color:#fbfbfb;
            -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
            -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
            box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
        }
        .tree li {
            list-style-type:none;
            margin:0;
            padding:10px 5px 0 5px;
            position:relative
        }
        .tree li::before, .tree li::after {
            content:'';
            left:-20px;
            position:absolute;
            right:auto
        }
        .tree li::before {
            border-left:1px solid #999;
            bottom:50px;
            height:100%;
            top:0;
            width:1px
        }
        .tree li::after {
            border-top:1px solid #999;
            height:20px;
            top:25px;
            width:25px
        }
        .tree li span {
            -moz-border-radius:5px;
            -webkit-border-radius:5px;
            border:1px solid #999;
            border-radius:5px;
            display:inline-block;
            padding:3px 8px;
            text-decoration:none
        }
        .tree li.parent_li>span {
            cursor:pointer
        }
        .tree>ul>li::before, .tree>ul>li::after {
            border:0
        }
        .tree li:last-child::before {
            height:30px
        }
        .tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
            background:#eee;
            border:1px solid #94a0b4;
            color:#000
        }
        li > .btn,li > form >.btn {
            margin: 5px;
            padding: 3px !important;
        }
        li.parent_li > ul > li{
            display: none;
        }
    </style>
@stop
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Category</h4>
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
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> {{session()->pull('success')}}.
                </div>
            @elseif(session()->has('errors'))
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <ul>
                        @foreach($errors->getMessages() as $error)
                            <li>{{$error[0]}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-default" href="{{route('admin.category.create')}}"> Add New </a>
                </div>
                <div class="panel-wrapper collapse in tree">

                </div>
            </div>
        </div>
    </div>
    <div id="deleteCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Delete <span id="categoryName"></span></h4>
                </div>
                <form method="post" class="deleteModal" data-baseurl="{{env('APP_URL')}}" action="">
                    {!! Form::token() !!}
                <div class="modal-body">
                        <div class="form-group">
                            <div class="checkbox checkbox-success">
                                <input id="checkbox1" type="checkbox" required>
                                <label for="checkbox1"> Are you sure? This will delete all template and special category associated with it.</label>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('page-specific-js')
    <script>
        var category = <?php echo $categories ?> ;
        var categoryHtml = '';
        categoryTree(category);
        $('.tree').html(categoryHtml);

        $(function () {
            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Expand this branch');
            $('.tree li.parent_li > span').on('click', function (e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(":visible")) {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').find(' > i').addClass(' fa-plus-circle').removeClass('fa-minus-circle');
                } else {
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').find(' > i').addClass(' fa-minus-circle').removeClass('fa-plus');
                }
                e.stopPropagation();
            });
        });

        $(document).ready(function(){

            $('[data-toggle="popover"]').popover({
                html: true,
                trigger: 'hover',
                placement: 'top',
                content: function(){return '<img src="'+$(this).data('img') + '" class="img-thumbnail" alt="Cinque Terre" width="110" height="75" />';}
            });

            $(document).on('click','.addNewCategoryButton',function(){
                var parentId = $(this).closest('li').data('parentid');
                var title = $(this).closest('li').data('title');

                $('#catName').empty().append(title);
                $('#parentId').val(parentId);
            });

            $(document).on('click','.deleteCategoryButton',function(){
                var id = $(this).data('id');
                var url = $('.deleteModal').data('baseurl');
                console.log(url);
                var deleteUrl = url+'/admin/category/'+id;
                $('.deleteModal').attr('action',deleteUrl);
            });

        });

        function categoryTree(category){
            categoryHtml = categoryHtml+'<ul>';
            for(var i=0;i<category.length;i++){
                var icon = ("children" in category[i] && category[i]['children'].length>0)?'<i class="fa fa-plus-circle"></i> ':' ';
                var id = category[i]["id"];
                {{--var editUrl = '{{route("admin.categories.edit",":id")}}';--}}
                var editUrl = '';
                var detailsUrl = '{{env('APP_URL')}}'+'/admin/category/'+id;
                {{--var deleteUrl = '{{route("admin.categories.destroy",":id")}}';--}}
                var deleteUrl = '';
                var imgUrl = category[i]['icon']?category[i]['icon']:'{{URL::to("category_icon")}}'+'/noimage.jpg';
                editUrl = editUrl.replace(':id',id);
                deleteUrl = deleteUrl.replace(':id',id);
                categoryHtml = categoryHtml + '<li data-parentid="'+category[i]['id'] +'" data-title="'+category[i]['name'] +'"><span>'+ icon + category[i]['id'] + ' . ' + category[i]['name'] +'</span>';
                        if(category[i]['parent_id']==0){categoryHtml+='<a type="button" class="btn btn-success addNewCategoryButton" href="'+detailsUrl+'"> Details </a>'}
                categoryHtml+='<a class="btn btn-primary" href="'+editUrl+'">Edit</a>'+
                        '<button type="button" class="btn btn-danger deleteCategoryButton" data-toggle="modal" data-target="#deleteCategory" data-id="'+category[i]['id']+'"> Delete </button>';
                if("children" in category[i]){
                    if(category[i]['children'].length>0){
                        categoryTree(category[i]['children']);
                    }
                }
                categoryHtml = categoryHtml + '</li>';
            }
            categoryHtml = categoryHtml + '</ul>';
        }
    </script>
@stop