@extends('backend.settings.setting-layout')

@section('title')
{{ __('Advertisement Settings') }}
@endsection

@section('website-settings')
<div class="container-fluid">
    <div class="alert alert-warning mb-3">
        <h5>{{ __('place_your_advertising_networks_code') }}</h5>
        <hr class="my-2">
        {{
        __('ad_code_is_a_piece_of_html_or_javascript_that_you_can_place_on_your_website_to_display_advertisements_with_ad_code_you_can_earn_revenue_by_displaying_ads_from_various_advertising_networks_like_google_adsense_which_matches_relevant_ads_to_the_content_on_your_website')
        }}.
        <strong>{{ __('click_the_eye_icon_to_see_position_place') }}</strong>.
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="line-height: 36px;">{{ __('advertisement_settings') }}</h3>
        </div>
        <form action="{{ route('settings.adinfo.update') }}" class="card-body" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row justify-content-center">
                @foreach ($ads as $ad)
                <input type="hidden" class="d-none" name="page_slug[]" value="{{ $ad->page_slug }}">
                <div class="col-12 col-md-6 mb-4">

                    <div class="float-start">
                        <label for="" class="">
                            <span id="span_text">
                                {{ Str::ucfirst(str_replace('_', ' ', $ad->page_slug)) }}
                            </span>
                            <span
                                onclick="showPlaceDemo('{{ Str::ucfirst(str_replace('_', ' ', $ad->page_slug)) }}','{{ $ad->page_slug }}')"
                                class="mt-2 ml-2">
                                <i class="fa fa-eye fa-lg p-1 text-info cursor-pointer"></i>
                            </span>
                        </label>
                    </div>
                    <div class="float-end">
                        <input class="tgl tgl-flip" data-bootstrap-switch data-id="{{ $ad->id }}"
                            name="{{ $ad->page_slug }}" id="{{ $ad->page_slug }}" type="checkbox" {{ $ad->status == 0 ?
                        '' : 'checked' }}>
                        <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="{{ $ad->page_slug }}"></label>
                    </div>

                    @if (
                    $ad->page_slug == 'home_page_ad' ||
                    $ad->page_slug == 'job_page_ad' ||
                    $ad->page_slug == 'job_detailpage_ad' ||
                    $ad->page_slug == 'job_detailpage_right_ad')
                    <textarea disabled rows="4" class="form-control"></textarea>
                    <input name="ad_code[]" type="text" hidden value="{{ $ad->ad_code }}">
                    @else
                    <textarea name="ad_code[]" rows="4" class="form-control">{{ $ad->ad_code }}</textarea>
                    @endif

                </div>
                @endforeach
            </div>
            <div class="row justify-content-center">
                <div class="col-4 text-center">
                    <button type="submit" class="btn bg-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
    <!-- example image show modal  -->
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="advertise_ttile">Modal title</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <img id="place_image" src="" alt="" style="width:400px;height:500px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- example image show modal  -->
</div>
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-switch/css/bootstrap4/bootstrap-switch.min.css') }}">
@endsection
@section('script')
<script>
    function showPlaceDemo(title, slug) {
            $('#advertise_ttile').text('');
            $('#advertise_ttile').text(title);
            var image_path = '{{ URL::to('/') }}' + '/' + 'dummy-data/images/companies/' + slug + '.webp';
            document.getElementById("place_image").src = image_path;

            $('#staticBackdrop').modal('show');
        }
        $(".switcher").bootstrapSwitch();
        $("input[data-bootstrap-switch]").on('switchChange.bootstrapSwitch', function(event, state) {
            let status = state ? 1 : 0;
            var id = $(this).data('id');

            $.ajax({
                url: "{{ route('settings.adstatus.update') }}",
                type: "PUT",
                data: {
                    'id': id,
                    'status': status,
                    _token: '{!! csrf_token() !!}'
                },
                beforeSend: function() {},
                complete: function() {},
                success: function(data) {
                    //console.log(data);
                }
            });
        });
</script>
@endsection