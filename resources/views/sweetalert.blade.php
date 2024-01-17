<div>
    @if (Session::has('success'))
        <script>
            swal("message","{{ session('success') }}",'success',{
                button:true,
                button:"Ok"
            })
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            swal("Error","{{ session('success') }}",'error',{
                button:true,
                button:"Ok"
            })
        </script>
    @endif
    @if ($errors->any())
        <script>
            var errorMessages = @json($errors->all());
            swal("Validation Error", errorMessages.join('<br>'), 'error', {
                button: true,
                button: "Ok"
            });
        </script>
    @endif

</div>
