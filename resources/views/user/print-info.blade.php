@extends('user.template.layout')
@section('title')
    Home
@stop
@section('page-specific-css')
@stop
@section('content')
    <section class="home-testimonial-section" style="margin:30px 0;">
        <div class="container ">
            <div class="row" >
                <div class="col-md-5">
                    <div class="choosed-design-box">
                        <h2 class="choosed-design-heading text-center">Design</h2>
                        @if(isset($template->template_id))
                            @if(isset($template->template_info->info))
                                @foreach(json_decode($template->template_info->info) as $key=>$item)
                                    <p class="choosed-design-img" style="text-align: center">
                                        <label > {{str_replace('_', ' ', $key)}} </label>
                                        <img class="text-center img-center" src="{{$item}}">
                                    </p>
                                @endforeach
                            @endif
                          @else
                            @foreach($template->template_info as $key=>$item)
                            <p class="choosed-design-img" style="text-align: center">
                                @if(strpos($item, 'image') == false)
                                    @continue
                                @endif
                                <label > {{str_replace('_', ' ', $key)}} </label>
                                <img class="text-center img-center" src="{{$item}}">
                            </p>
                            @endforeach
                        @endif
                    </div>
                </div>
                @php
                    $view_image = isset($template->template_id) && isset($template->template_info->image) ? $template->template_info->image : '/images/product/263x263/no-image.jpg';
                @endphp
                <div class="col-md-7">
                    <div class="choosed-design-box">
                        <h2 class="choosed-design-heading text-center">Write Print Info Below</h2>
                          {!! Form::open(array('method'=>'post','route'=>['print.info.post'],'files'=>'ture','class'=>'print-info-form')) !!}
                          @php
                            if($categoryDetails->parent_id){
                                $categoryPrint = $categoryDetails->parent->categoryPrint;
                            }else{
                                $categoryPrint = $categoryDetails->categoryPrint;
                            }
                            echo "<input type='hidden' name='category_id' value='$template->category_id'/>";
                            $count = 0;
                            if(isset($template->template_id)){
                               echo "<input type='hidden' name='template_id' value='$template->template_id'/>"
                                     ."<input type='hidden' name='view_image' value='$view_image'/>";
                               if(count($template->template_info->info)>1){
                                    foreach(json_decode($template->template_info->info) as $key=>$item){
                                        echo "<input type='hidden' name='$key' value='$item' />";
                                    }
                               }
                            } else {
                                foreach($template->template_info as $key=>$item){
                                  echo "<input type='hidden' name='$key' value='$item' />";
                                  if ($count == 0)
                                    echo "<input type='hidden' name='view_image' value='$item' />";
                                   $count++;
                                }
                            }
                          @endphp
                          @if(!empty($categoryPrint))
                              @foreach($categoryPrint as $key=>$item)
                                  @if($item->field_type=='file')
                                  <div class="form-group">
                                    @if(!empty($item->label))
                                      <label for="{{str_replace(' ', '_', $item->placeholder)}}">{{$item->label}}</label>
                                    @endif
                                      <input type="file" class="form-control" name="{{str_replace(' ', '_', $item->placeholder)}}" id="{{str_replace(' ', '_', $item->placeholder)}}" placeholder="{{$item->placeholder}}" required>
                                  </div>
                                  @elseif($item->field_type=='text')
                                      <div class="form-group">
                                        @if(!empty($item->label))
                                          <label for="{{str_replace(' ', '_', $item->placeholder)}}">{{$item->label}}</label>
                                        @endif
                                          <input class="form-control" name="{{str_replace(' ', '_', $item->placeholder)}}" type="text" id="{{str_replace(' ', '_', $item->placeholder)}}" placeholder="{{$item->placeholder}}" required>
                                      </div>
                                  @elseif($item->field_type=='checkbox')
                                      <div class="form-group padding-left-right">
                                        @if(!empty($item->label))
                                          <label for="{{str_replace(' ', '_', $item->placeholder)}}">{{$item->label}}</label><br>
                                        @endif
                                          @foreach(json_decode($item->values) as $key=>$value)
                                              @if($key==0)
                                                  <label class="checkbox-inline">
                                                      <input type="checkbox" name="{{str_replace(' ', '_', $item->placeholder)}}" value="{{$value}}" checked>{{$value}}
                                                  </label>
                                                  {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}" checked> {{$value}}<br>--}}
                                              @else
                                                  {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}"> {{$value}}<br>--}}
                                                  <label class="checkbox-inline">
                                                      <input type="checkbox" name="{{str_replace(' ', '_', $item->placeholder)}}" value="{{$value}}" >{{$value}}
                                                  </label>
                                              @endif
                                          @endforeach
                                      </div>
                                  @elseif($item->field_type=='select')
                                    @if(!empty($item->label))
                                      <label for="{{str_replace(' ', '_', $item->placeholder)}}">{{$item->label}}</label><br>
                                    @endif
                                      <select name="{{$item->label}}" class="form-control" id="{{str_replace(' ', '_', $item->placeholder)}}">
                                          @foreach(json_decode($item->values) as $key=>$value)
                                              <option value="{{$value}}">{{$value}}</option>
                                          @endforeach
                                      </select>
                                  @elseif($item->field_type=='radio')
                                      <div class="form-group padding-left-right">
                                          <label for="{{str_replace(' ', '_', $item->placeholder)}}">{{$item->label}} </label><br>
                                          @foreach(json_decode($item->values) as $key=>$value)
                                              @if($key==0)
                                                  <label class="radio-inline">
                                                      <input type="radio" name="{{str_replace(' ', '_', $item->placeholder)}}" value="{{$value}}" checked>{{$value}}
                                                  </label>
                                                  {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}" checked> {{$value}}<br>--}}
                                              @else
                                                  {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}"> {{$value}}<br>--}}
                                                  <label class="radio-inline">
                                                      <input type="radio" name="{{str_replace(' ', '_', $item->placeholder)}}" value="{{$value}}" >{{$value}}
                                                  </label>
                                              @endif
                                          @endforeach
                                      </div>
                                @elseif($item->field_type=='textarea')
                                    <div class="form-group">
                                        @if(!empty($item->label))
                                            <label for="{{str_replace(' ', '_', $item->placeholder)}}">{{$item->label}}</label>
                                        @endif
                                            <textarea class="form-control" name="{{str_replace(' ', '_', $item->placeholder)}}" rows="4" id="{{str_replace(' ', '_', $item->placeholder)}}" placeholder="{{$item->placeholder}}" required></textarea>
                                    </div>
                                  @else
                                    <div class="form-group">
                                      @if(!empty($item->label))
                                        <label for="{{str_replace(' ', '_', $item->placeholder)}}">{{$item->label}}</label>
                                      @endif
                                        <input class="form-control" name="{{str_replace(' ', '_', $item->placeholder)}}" type="{{$item->field_type}}" id="{{str_replace(' ', '_', $item->placeholder)}}" placeholder="{{$item->placeholder}}" required>
                                    </div>
                                  @endif
                              @endforeach
                          @endif
                          <div class="form-group">
                              <button type="submit" class="btn btn-success"> Proceed to Next </button>
                          </div>
                          {!! Form::close() !!}
                            <!-- <div class="form-group">
                                <input type="text" class="form-control" id="pwd" placeholder="Zip Code">
                            </div>
                            <div class="form-group">
                                <label for="email">Other Information</label>
                                <textarea  rows="4" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="email">You can upload a picture</label>
                                <input type="file" class="form-control" id="email" placeholder="Street Address">
                            </div> -->
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
