<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 footer-copyright d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <strong> &copy; <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> {{ date('Y') }}
                    </strong>.
                    {{ __('all_rights_reserved') }}.
                </div>
                <div class="float-right d-none d-sm-inline-block pr-5">
                    <b>{{ __('version') }}</b> {{ config('app.version') }}
                </div>
            </div>
        </div>
    </div>
</footer>
