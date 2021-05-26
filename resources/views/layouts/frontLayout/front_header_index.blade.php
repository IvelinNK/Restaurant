<?php use App\Holiday; ?>
<!-- Header Area wrapper Starts -->
<header id="header-wrap">
    @if (!empty($errors) && $errors->any())
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
</header>
<!-- Header Area wrapper End -->
