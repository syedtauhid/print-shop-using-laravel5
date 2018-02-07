@extends('user.template.layout')
@section('title')
    Contact
@stop
@section('page-specific-css')
@stop
@section('content')
    <section id="pr-contact" class="pr-main">
        <div class="container"><h1 class="ct-header">Contact us</h1></div>

        <div class="container">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="address">
                    <i class="fa fa-home"></i>
                    <p>
                        <span>Stress: 37-66 72th Street Jackson Heights</span><br />
                        <span>State: NY </span><br />
                        <span>Zip Code: 11372 </span><br />
                        <span>Country: USA </span>
                    </p>
                </div>
                <div class="phone">
                    <i class="fa fa-phone"></i>
                    <p>
                        <span>Telephone: +6466415348</span>
                    </p>
                </div>

                <div class="website">
                    <i class="fa fa-globe"></i>
                    <p>
                        <span>Website: dgdprint.com </span>
                    </p>
                </div>
            </div>
            <form id="contact-form" class="form-validate form-horizontal" method="post" action="#" />
            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea aria-required="true" required="required" class="required invalid" rows="10" cols="50" id="jform_contact_message" name="contact_message" aria-invalid="true" placeholder="Message *"></textarea>
                <p>Ask us a question and we'll write back to you promptly! Simply fill out the form below and click Send Email.</p>
                <p>Thanks. Items marked with an asterisk (<span class="star">*</span>) are required fields.</p>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12">
                <input class="name" type="text" value="" placeholder="Enter your name *" required/>
                <input class="email" type="email" value="" placeholder="Enter E-mail *" required/>
                <input class="mesage" type="text" value="" placeholder="Enter Mesage Subject *" required/>
                {{--<div class="button">--}}
                    {{--<input class="subject" type="checkbox" value="Enter Mesage Subject *" />--}}
                    {{--<span>Send copy to yourself</span>--}}
                {{--</div>--}}
                <button type="submit" class="sendmail">Submit</button>
            </div>
            </form>
            <div class="contact-map">
                <!--<img src="images/maps.jpg" />-->
                <iframe width="100%" height="500" frameborder="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=37-66+72nd+St,+Jackson+Heights,+NY+11372,+USA&amp;output=embed" marginwidth="0" marginheight="0" scrolling="no"></iframe>
            </div>
        </div>
    </section>
@endsection
@section('page-specific-js')
<script>
    $("#contact-form").submit(function(e){
        e.preventDefault();
        waitingDialog.show("submitting..");
        setTimeout(function(){
            waitingDialog.hide();
            swal("Thanks for contacting us!","We will get in touch with you shortly", "success");
        }, 1000)
        this.reset();
    });
</script>
@stop
