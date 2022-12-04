<div>
    @if ($message = Session::get('success'))
        <div class="alert-success" data-message="{{ $message }}"></div>
    @elseif ($message = Session::get('error'))
        <div class="alert-error" data-message="{{ $message }}"></div>
    @endif

</div>

@push('script')
    <script>
        if ($('.alert-success').data('message')) {
            // Toast.fire({
            //     icon: 'success',
            //     title: $('.alert-success').data('message'),
            // })
      

            toastr.success(
                $('.alert-success').data('message'),
                'Success'
            );

        } else if ($('.alert-error').data('message')) {
            // Toast.fire({
            //     icon: 'error',
            //     title: $('.alert-error').data('message'),
            // })
       
            toastr.error(
                $('.alert-error').data('message'),
                'Error'
            );
        }
    </script>
@endpush

@php
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
@endphp
