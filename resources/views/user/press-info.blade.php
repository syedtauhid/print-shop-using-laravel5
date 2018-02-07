@extends('user.template.layout')
@section('title')
    Home
@stop
@section('page-specific-css')
@stop
@section('content')
    <section class="home-testimonial-section" style="margin:30px 0;">
        @php
            if($categoryDetails->parent_id){
                $categoryPress = $categoryDetails->parent->categoryPress;
                $priceDependency = $categoryDetails->parent->CategoryPriceDependency;
                $priceMap = $categoryDetails->parent->categoryPriceMap;
            }else{
                $categoryPress = $categoryDetails->categoryPress;
                $priceDependency = $categoryDetails->CategoryPriceDependency;
                $priceMap = $categoryDetails->categoryPriceMap;
            }
            //dd($priceDependency);
            $priceDependencyNames = array();
            $priceMapNames = array();
            $priceMapValues = array();
            foreach ($priceDependency as $key=>$item){
                $item = $item->categoryPress;
                //dd($item);
                //array_push($priceDependencyNames,str_replace(' ','_',trim($item->placeholder)));
                $data = str_replace(' ','_',trim($item->placeholder));
                $priceDependencyNames[$item->id] = $data;
            }
            foreach ($priceMap as $key=>$item){
                array_push($priceMapValues,json_decode(trim($item->price)));
                foreach (json_decode($item->price) as $key1=>$value)
                    array_push($priceMapNames,trim($value));
            }
        //dd($priceDependencyNames);
        $priceMapValues = json_encode($priceMapValues);
        @endphp
<div class="container ">
<div class="row" >
<div class="col-md-5">
    <div class="row">
        <div class="col-md-12">
            <div class="choosed-design-box">
                <h2 class="choosed-design-heading text-center">Your Design</h2>
                <p class="choosed-design-img">
                    <img class="text-center" src="{{!empty($print->print_info->view_image)?$print->print_info->view_image:''}}">
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="well press-price" style="border-radius:0px" id="core_price">
                Price : $0
            </div>
            <div class="well press-price" style="border-radius:0px">
                SALES TAX : 8.875% (WRITE AMOUNT)
            </div>
            <div class="well press-price" style="border-radius:0px" id="net_price">
                Total : $0
            </div>
            <div class="button-group inline">
                <button class="btn btn-info" id="add-to-cart">
                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                    Add to Cart
                </button>
                <button class="btn btn-success" id="proceed-to-checkout">
                    <i class="fa fa-money" aria-hidden="true"></i>
                    Proceed to Checkout
                </button>
            </div>
        </div>
    </div>
</div>
<div class="col-md-7">
    <div class="choosed-design-box">
        <p style="padding:20px 20px 0 20px;">
            OUR STANDARD TURNAROUND TIME IS 24 HOURS OR SOONER FOR
            AQUEOUS COATING AND UV 1 SIDE ORDERS 3-4 DAYS. (FOLDING, NUMBERING,
            PERFORATION, DIE CUTTING, DRILLING ETC.) ALLOW AN ADDITIONAL
            12-24 HOURS TO FULFILL ORDER.
        </p>
          {!! Form::open(array('method'=>'post','route'=>['press.info.post'],'files'=>'ture','class'=>'print-info-form','id'=>'pressInfoForm')) !!}
          @php
            foreach($print->print_info as $key=>$item){
                echo "<input type='hidden' name='$key' value='$item' />";
            }
            $pressInfoSize = count($categoryPress);
            echo "<input type='hidden' name='press_info_size' value='$pressInfoSize' />";
          @endphp
                            <input type="hidden" id="total-price" name="total_price" value="0"/>
                            <input type="hidden" id="price" name="price" value="0"/>
                            <input type="hidden" id="tax" name="tax" value="0"/>
                            <div class="form-group">
                                <input class="form-control" name="PROJECT_NAME" type="text"   placeholder="PROJECT NAME" required>
                            </div>
                          @if(!empty($categoryPress))
                              @foreach($categoryPress as $key=>$item)
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
                                          <label for="{{str_replace(' ', '_', str_replace(':','',$item->placeholder))}}">{{$item->label}}</label>
                                        @endif
                                            <input class="form-control" name="{{str_replace(' ','_',str_replace(':','',trim($item->placeholder)))}}" type="text" id="{{str_replace(' ','_',str_replace(':','',trim($item->placeholder)))}}" onblur={{isset($priceDependencyNames[$item->id]) ? "calculatePrice()" : ""}} placeholder="{{$item->placeholder}}" required>
                                      </div>
                                  @elseif($item->field_type=='checkbox')
                                      <div class="form-group padding-left-right">
                                        @if(!empty($item->label))
                                          <label for="{{str_replace(' ', '_', $item->placeholder)}}">{{$item->label}}</label><br>
                                        @endif
                                          @foreach(json_decode($item->values) as $key=>$value)
                                                @if(isset($priceDependencyNames[$item->id]) && !in_array($value, $priceMapNames))
                                                    @continue
                                                @endif
                                              @if($key==0)
                                                  <label class="checkbox-inline">
                                                          <input type="checkbox" name="{{str_replace(' ','_',str_replace(':','',trim($item->placeholder)))}}" value="{{$value}}" checked onclick={{isset($priceDependencyNames[$item->category_id]) ? "calculatePrice()" : ""}}>{{$value}}
                                                  </label>
                                                  {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}" checked> {{$value}}<br>--}}
                                              @else
                                                  {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}"> {{$value}}<br>--}}
                                                  <label class="checkbox-inline">
                                                      <input type="checkbox" name="{{str_replace(' ','_',str_replace(':','',trim($item->placeholder)))}}" value="{{$value}}" onclick={{isset($priceDependencyNames[$item->id]) ? "calculatePrice()" : ""}}>{{$value}}
                                                  </label>
                                              @endif
                                          @endforeach
                                      </div>
                                  @elseif($item->field_type=='select')
                                    @if(!empty($item->label))
                                      <label for="{{str_replace(' ', '_', $item->placeholder)}}">{{$item->label}}</label><br>
                                    @endif
                                    <div class="form-group">
                                      <select name="{{str_replace(' ','_',str_replace(':','',trim($item->placeholder)))}}" class="form-control" id="{{str_replace(' ', '_', $item->placeholder)}}" onchange={{isset($priceDependencyNames[$item->id]) ? "calculatePrice()" : ""}}>
                                          @foreach(json_decode($item->values) as $key=>$value)
                                              <option value="{{$value}}">{{$value}}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                  @elseif($item->field_type=='radio')
                                      <div class="form-group">
                                          <label for="{{str_replace(' ', '_', $item->placeholder)}}">{{$item->label}} </label><br>
                                          @foreach(json_decode($item->values) as $key=>$value)
                                              @if($key==0)
                                                  <label class="radio-inline">
                                                      <input type="radio" name="{{str_replace(' ','_',str_replace(':','',trim($item->placeholder)))}}" value="{{$value}}" checked>{{$value}}
                                                  </label>
                                                  {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}" checked> {{$value}}<br>--}}
                                              @else
                                                  {{--<input class="inline" type="{{$item->field_type}}" name="gender" value="{{$value}}"> {{$value}}<br>--}}
                                                  <label class="radio-inline">
                                                      <input type="radio" name="{{str_replace(' ','_',str_replace(':','',trim($item->placeholder)))}}" value="{{$value}}" >{{$value}}
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
                                  @elseif($item->field_type=='number')
                                    <div class="form-group">
                                      @if(!empty($item->label))
                                        <label for="{{str_replace(' ', '_', $item->placeholder)}}">{{$item->label}}</label>
                                      @endif
                                        <input class="form-control" name="{{str_replace(' ', '_', $item->placeholder)}}" type="{{$item->field_type}}" id="{{str_replace(' ', '_', $item->placeholder)}}" placeholder="{{$item->placeholder}}" onkeyup={{isset($priceDependencyNames[$item->id]) ? "calculatePrice()" : ""}} onblur={{isset($priceDependencyNames[$item->id]) ? "calculatePrice()" : ""}} required>
                                    </div>
                                  @endif
                              @endforeach
                          @endif
                          {!! Form::close() !!}
                            <!-- <div class="form-group">
                                <label for="email">Project Name</label>
                                <input type="text" class="form-control" id="email" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Quantity</label>
                                <input type="number" class="form-control" id="pwd" >
                            </div>
                            <div class="form-group">
                                <label for="email">Quoting</label>
                                <select class="form-control">
                                    <option> Uv Double Side </option>
                                    <option> Both Side Uv </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Paper Stock</label>
                                <select class="form-control">
                                    <option> 12pt </option>
                                    <option> 14pt </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Side to be Printed</label>
                                <select class="form-control">
                                    <option> 0/0 </option>
                                    <option> 0/4 </option>
                                </select>
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="email">Rounded Corners</label>
                                <select class="form-control">
                                    <option> Round </option>
                                    <option> No Round </option>
                                </select>
                            </div>
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@section('page-specific-js')
<script>
    function decodeHTMLEntities(text) {
        var entities = [
            ['amp', '&'],
            ['apos', '\''],
            ['#x27', '\''],
            ['#x2F', '/'],
            ['#39', '\''],
            ['#47', '/'],
            ['lt', '<'],
            ['gt', '>'],
            ['nbsp', ' '],
            ['quot', '"']
        ];

        for (var i = 0, max = entities.length; i < max; ++i)
            text = text.replace(new RegExp('&'+entities[i][0]+';', 'g'), entities[i][1]);

        return text;
    }

    function prepareDependencyJSON(data) {
        var arr = [];
        try {
            var json = JSON.parse(data);
            for (var key in json){
                var value = json[key];
                arr.push(value);
            }
        } catch(e) {
            console.log(e);
        }
        return arr;
    }
    var ADD_TO_CART_URL = "{{route('press.info.cart')}}";
    var CHECKOUT_URL = "{{route('view.cart')}}";
    var DEPENDENCY = decodeHTMLEntities("{{json_encode($priceDependencyNames)}}");
    var PRICE = decodeHTMLEntities("{{$priceMapValues}}");
    var DEPENDENCY_JSON = prepareDependencyJSON(DEPENDENCY);
    var PRICE_JSON = JSON.parse(PRICE);
    var BASE_DEPENDENCY = "Quantity";
    var TAX_PERCENT = 8.875;

    window.onload = function () {
        calculatePrice();
    };
</script>
@stop
