<script>
            function check_balance(userId, currency) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                    type:'POST',
                    url:"{{ route('admin.show') }}",
                    data: { user_id: userId, currency: 'BTC' },
                    success: function (data) {
                        if($.isEmptyObject(data.error)) {
                            alert(data);
                        } else {
                            console.log(data.error);
                        }
                    }
                });
            
            }
        </script>