<!-- BEGIN: Vendor JS-->
{{-- <script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script> --}}
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> --}}
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script> --}}
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
{{-- <script src="/assets/js/bootstrap.min.js"></script> --}}
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/sweetalert2.min.js')) }}"></script>
<script src="{{ asset(mix('assets/js/dropify.min.js')) }}"></script>

<script src="{{ asset('assets/js/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.min.js') }}"></script>


<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->



<script>
    // copyToClipboard funtion
    function copyToClipboard() {
        $('#copyBtn').val('Copied');
        let Text = $('#apiToken').text();
        navigator.clipboard.writeText(Text);
    }

    @if (app()->getLocale() == 'ar')
        $.extend(true, $.fn.dataTable.defaults, {
            "language": {
                "decimal": "",
                "emptyTable": "لم يتم العثور على سجلات مطابقة",
                "info": "يعرض _START_ إلى _END_ من _TOTAL_ السجلات",
                "infoEmpty": "يعرض 0 إلى 0 من 0 السجلات",
                "infoFiltered": "(تمت تصفيته من _MAX_ المجموع السجلات)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "يعرض _MENU_ السجلات",
                "loadingRecords": "جار التحميل...",
                "processing": "جار التحميل...",
                "search": "يبحث:",
                "zeroRecords": "لم يتم العثور على نتائج",
                "paginate": {
                    "first": "أول",
                    "last": "الاخير",
                    "next": "التالي",
                    "previous": "السابق"
                },
                "aria": {
                    "sortAscending": ": تفعيل لفرز العمود تصاعديا",
                    "sortDescending": ": تفعيل لفرز العمود تنازليًا"
                }
            }
        });
    @endif
</script>
