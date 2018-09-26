<div class="contentRow flex center ">
    <div class="list-title label push-right">{{ __('main.share') }}:</div>
    <ul class="social-media-list standard-social">
        <li><a href="" data-share="https://twitter.com/share?url=" class="icomoon icon-twitter"></a></li>
        <li><a href="" data-share="https://www.facebook.com/sharer/sharer.php?u=" class="icomoon icon-facebook"></a></li>
    </ul>
</div>

@section('scripts')

    <script language="javascript">

        $('.social-media-list li a').on('click', function (e) {
            e.preventDefault();
            var left = (screen.width/2)-(600/2);
            var top = (screen.height/2)-(300/2);

            window.open($(this).data('share')+(window.location.href)+"&t="+document.title, '',
            'menubar=no,toolbar=no,allowtransparency="true",resizable=yes,scrollbars=yes,height=300,width=600,top='+top+',left='+left);
            return false;

        });
    </script>

@endsection

