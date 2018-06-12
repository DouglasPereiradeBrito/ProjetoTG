@if($errors->any())
    <div class="box box box-warning box-solid">
        <div class='box-header'>
            @foreach ($errors->all() as $error)
            <h3 class="box-title">{{ $error }}</h3><br>
            @endforeach
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
    </div>
@endif

@if(session('success'))
    <div class="box box box-success box-solid">
        <div class='box-header'>
            <h3 class="box-title">{{ session('success') }}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="box box box-warning box-solid">
        <div class='box-header'>
            <h3 class="box-title">{{ session('error') }}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
    </div>
@endif

@if(session('excluir'))
    <div class="box box box-warning box-solid">
        <div class='box-header'>
            <h3 class="box-title">{{ session('excluir') }}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
    </div>
@endif