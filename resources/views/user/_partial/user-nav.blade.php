<aside class="col-md-3 col-sm-4 col-xs-12 account-sidebar sidebar">
    <h3 class="acc-title lg">Account</h3>
    <ul>
        <li id="profile_info">
            <a href="{{route('user.info')}}">Profile information</a>
        </li>
        <li id="certificate_info">
            <a href="{{route('user.tax-exempt')}}">Resale Certificate</a>
        </li>
        <li id="card_info">
            <a href="{{route('user.card-information')}}" >Credit Cards</a>
        </li>
        <li id="proof_info">
            <a href="{{route('user.proof-review')}}" >Proof Review</a>
        </li>
        <li id="order_info">
            <a href="{{route('uesr.order-history')}}">Order History</a>
        </li>
        <li id="refer_friend">
            <a href="{{route('user.refer')}}">Refer A Friend Program</a>
        </li>
    </ul>
</aside>