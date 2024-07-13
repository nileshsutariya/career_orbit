<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
<script src="{{ asset('backend/assets/js/scrollbar/simplebar.js') }}"></script>
<script src="{{ asset('backend/assets/js/scrollbar/custom.js') }}"></script>
<script src="{{ asset('backend/assets/js/config.js') }}"></script>
<script src="{{ asset('backend/assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('backend/assets/js/sidebar-pin.js') }}"></script>
<script src="{{ asset('backend/assets/js/height-equal.js') }}"></script>
<script src="{{ asset('backend/assets/js/animation/wow/wow.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/script.js') }}"></script>
<script src="{{ asset('backend/assets/js/rating/jquery.barrating.js') }}"></script>
<script src="{{ asset('backend/assets/js/rating/rating-script.js') }}"></script>
<script src="{{ asset('backend/assets/js/owlcarousel/owl.carousel.js') }}"></script>
<script src="{{ asset('backend/assets/js/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('backend/assets/js/dropzone/dropzone-script.js') }}"></script>
<script src="{{ asset('backend/assets/js/map-js/leaflet.js') }}"></script>
<script src="{{ asset('backend/assets/js/map-js/custom.js') }}"></script>
<script src="{{ asset('backend/assets/js/tooltip-init.js') }}"></script>
<script src="{{ asset('backend/assets/js/modalpage/validation-modal.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/flat-pickr/custom-flatpickr.js') }}"></script>
<script src="{{ asset('backend/assets/js/height-equal.js') }}"></script>
<script src="{{asset('backend/assets/js/editor/summernote/summernote.js')}}"></script>
<script src="{{asset('backend/assets/js/editor/summernote/summernote.custom.js')}}"></script>
<script src="{{asset('backend/assets/js/editor/summernote/summernote-custom1.js')}}"></script>

<script src="{{ asset('backend/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/datatable/datatable-extension/custom.js')}}"></script>
<script src="{{ asset('backend/assets/js/tooltip-init.js') }}"></script>

<script src="{{ asset('backend/assets/js/select2/tagify.js') }}"></script>
<script src="{{ asset('backend/assets/js/select2/tagify.polyfills.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/select2/intltelinput.min.js') }}"></script>


<script src="{{asset('backend/assets/js/jquery.ui.min.js')}}"></script>
<script src="{{asset('backend/assets/js/slick/slick.min.js')}}"></script>
<script src="{{asset('backend/assets/js/slick/slick.js')}}"></script>
<script src="{{asset('backend/assets/js/header-slick.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    new WOW().init();
</script>

<script>$('.select2').select2();</script>
<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}", 'Success!')
    @endif

    @if (Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}", 'Warning!')
    @endif

    @if (Session::has('error'))
        toastr.error("{{ Session::get('error') }}", 'Error!')
    @endif

    // toast config
    // toastr.options = {
    //     "closeButton": false,
    //     "debug": false,
    //     "newestOnTop": true,
    //     "progressBar": true,
    //     "positionClass": "toast-top-right",
    //     "preventDuplicates": true,
    //     "onclick": null,
    //     "showDuration": "300",
    //     "hideDuration": "1000",
    //     "timeOut": "5000",
    //     "extendedTimeOut": "1000",
    //     "showEasing": "swing",
    //     "hideEasing": "linear",
    //     "hideMethod": "fadeOut"
    // }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Navbar Collapse Toggle
    var isNavCollapse = JSON.parse(localStorage.getItem("sidebar_collapse"))
    isNavCollapse ? $('body').addClass('sidebar-collapse') : null;

    $('#nav_collapse').on('click', function() {
        localStorage.setItem("sidebar_collapse", isNavCollapse == true ? false : true);
    });
</script>
<!-- Custom Script -->
<script>
    // notification read
    function ReadNotification() {
        $.ajax({
            url: "{{ route('admin.notification.read') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(data) {
                $('#unNotifications').html('');
            }
        });
    }
    // call tooltip function
    $('[data-toggle="tooltip"]').tooltip();
    // Call ckeditor
    if (document.querySelector('#image_ckeditor')) {
        ClassicEditor.create(document.querySelector('#image_ckeditor'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
                },
            })
            .catch(error => {
                console.error(error);
            });
    }
    // Call ckeditor
    if (document.querySelector('#image_ckeditor_2')) {
        ClassicEditor.create(document.querySelector('#image_ckeditor_2'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
                },
            })
            .catch(error => {
                console.error(error);
            });
    }


    if (document.querySelector('#editor4')) {
        ClassicEditor.create(document.querySelector('#editor4'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '500px';
            })
            .catch(error => {
                console.error(error);
            });
    }

    if (document.querySelector('#editor2')) {
        ClassicEditor.create(document.querySelector('#editor2'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '500px';
            })
            .catch(error => {
                console.error(error);
            });
    }

    if (document.querySelector('#editor3')) {
        ClassicEditor.create(document.querySelector('#editor3'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '500px';
            })
            .catch(error => {
                console.error(error);
            });
    }

    function setLocationSession(form) {
        axios.post('/set/session', form)
            .then((res) => {
                // console.log(res.data);
                // toastr.success("Location Saved", 'Success!');
            })
            .catch((e) => {
                toastr.error("Something Wrong", 'Error!');
            });
    }
    $('#filterForm').on('change', function() {
        $(this).submit();
    })
</script>

@yield('script')
