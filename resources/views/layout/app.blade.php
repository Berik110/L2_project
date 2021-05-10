<html>
<head>
    <title></title>
    @include('layout.header')
</head>
<body class="mb-5">
    @include('layout.navbar')
    @include('auth.login')
    @include('auth.register')

    <div class="container-fluid">
        @yield('content')
    </div>

</body>
<div class="container-fluid">
    @include('layout.footer')
</div>
{{--<script type="text/javascript">--}}
{{--    function loadSubcat(){--}}
{{--        var categoryId = $("#category_id").val();--}}
{{--        // alert(countryId);--}}
{{--        $.get("loadcities",--}}
{{--            {--}}
{{--                oblast_id: oblastId--}}
{{--            },--}}
{{--            function(result){--}}
{{--                // alert(result);--}}
{{--                var cities = JSON.parse(result);--}}
{{--                var citiesOptions = "<option value='0'>Выбрать город</option>";--}}

{{--                for (i in cities){--}}
{{--                    citiesOptions+="<option value='"+cities[i]['id']+"'>"+cities[i]['name']+"</option>";--}}
{{--                }--}}
{{--                // console.log(citiesOptions)--}}
{{--                $("#city_id").html(citiesOptions);--}}
{{--            });--}}
{{--    }--}}
{{--</script>--}}
@yield('custom.js')
<script>
    $('#category').on('change', function(e){
        console.log(e);

        let cat_id = e.target.value;

        $.get('/ajax-subcat?cat_id=' + cat_id, function(data){
            $('#subcategory').empty();
            $.each(data, function (index, subcatObj){
                $('#subcategory').append('<option value="'+subcatObj.id+'">'+ subcatObj.name +'</option>');
            });
        });
    });
</script>
</html>
