@if (session()->has('flash_message'))
    <div class="notification">
        <button class="close-notification">&times;</button>
        <div class="message">
            {{ session('flash_message') }}
        </div>
        <!-- /.message -->
    </div>
    <!-- /.notification -->
@endif
