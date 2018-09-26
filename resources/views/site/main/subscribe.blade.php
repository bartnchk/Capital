<section class="pageSection smallSection">
    <div class="mcontainer">
        <div class="content-wrapper">
            <h2 class="title section-title">{{ trans('main.get_news') }}</h2>

            <form action="{{ route('subscribe') }}" class="subscribe-form" id="newsSubscribeForm">
                <div class="formRow relative">
                    <input id="subscribe-email" class="border-decor" type="email" placeholder="Ваш email" name="email" data-text-color="white" data-validate="isEmail" data-error-text="Некорректный e-mail">
                    <button id="subscribe" class="standardButton black border-decor submitButton  newsSubscribeButton">{{ trans('main.subscribe') }}</button>
                </div>
            </form>
        </div>
    </div>
</section>