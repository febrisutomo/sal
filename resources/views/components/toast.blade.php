<div>
    @if ($message = Session::get('success'))
        <div class="alert-success" data-message="{{ $message }}"></div>
    @endif
</div>

@push('script')
    <script>
        if ($('.alert-success').data('message')) {
            Toast.fire({
                icon: 'success',
                title: $('.alert-success').data('message'),
            })
        }
    </script>
@endpush
