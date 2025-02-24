@extends('templates.dashboard.app')

@section('content')
<form action="{{ route('dashboard.data-master.voucher.update', $voucher->id) }}" method="post">
    <div class="card-body">
        @csrf

        <div class="form-group">
            <label for="discount">Diskon</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                </div>
                <input type="text" name="discount" class="form-control currency-format"
                    placeholder="Masukkan nominal diskon"
                    value="{{ old('discount') ? number_format(old('discount'),0,',','.') : number_format($voucher->discount,0,',','.') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="expired_at">Kadaluarsa</label>
            <input type="hidden" name="expired_at"
                value="{{ old('expired_at', date('Y-m-d', strtotime($voucher->expired_at))) }}">
            <div id="kt_datepicker_6"></div>
        </div>
    </div>
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="{{ route('dashboard.data-master.voucher.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection

@section('js')
<script>
    var KTBootstrapDatepicker = function () {
        var arrows;
        if (KTUtil.isRTL()) {
            arrows = {
                leftArrow: '<i class="la la-angle-right"></i>',
                rightArrow: '<i class="la la-angle-left"></i>'
            }
        } else {
            arrows = {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        }

        var demos = function () {
            $('#kt_datepicker_6').datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                templates: arrows,
                format: 'yyyy-mm-dd',
                autoclose: true
            }).on('changeDate', function(e) {
                $('input[name="expired_at"]').val(e.format('yyyy-mm-dd'));
            });
        }

        return {
            init: function() {
                demos();
            }
        };
    }();

    jQuery(document).ready(function() {
        KTBootstrapDatepicker.init();
        let initialDate = $('input[name="expired_at"]').val();
        $('#kt_datepicker_6').datepicker('setDate', initialDate);
    });

    $('form').on('submit', function(e) {
        e.preventDefault();
        let discount = $('.currency-format').val();
        $('input[name="discount"]').val(formatCurrency.cleanValue(discount));
        $(this).unbind('submit').submit();
    });
</script>
@endsection