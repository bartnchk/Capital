<div class="sectionBlock questionsFormBlock">
    <div class="content-wrapper">
        <h2 class="title article-title">{{ trans('main.have_questions') }}</h2>
        <div class="title-description">{{ trans('main.callbacks_free') }} 0 800 300 703 {{ trans('main.callbacks_request_message') }}</div>

        <form action="{{ route('callbacks.send') }}" class="questions-form standard-form" id="faq_callback_form">
            <div class="formRow">
                <input class="border-decor" name="name" type="text" placeholder="{{ trans('main.your_name') }}">
            </div>
            <div class="formRow">
                <input class="border-decor" name="phone" type="text" placeholder="{{ trans('main.your_phone') }}"
                       data-validate="required" data-error-text="Поле обязательно к заполнению" required>
            </div>

            <div class="submitButtonWrapper">
                <div class="more-button inversed">
                    <div class="more-button-wrapper">
                        <div class="more-button-container">
                            <button class="title semi-bold callbackSubmitButton">{{ trans('main.send') }}</button>
                            <i class="icomoon standard-arrow-icon inversed"></i>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>