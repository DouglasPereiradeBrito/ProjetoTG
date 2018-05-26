<ul class="breadcrumb">
    <li><i class="fa fa-home"></i>  <a href="{{ route('home') }}">Home</a></li>
    @for($i = 1; $i <= count(Request::segments()); $i++)
        <li><a href="">{{ ucfirst (Request::segment($i)) }}</a></li>
    @endfor
</ul>