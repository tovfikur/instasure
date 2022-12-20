<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <p><strong>Query Details</strong></p>


    <div>
        @foreach ($visitor_info as $key => $row)
            <p>
                <strong>
                    {{ str_remove_dashes_custom(ucwords($key)) }}:
                </strong>
                <span>
                    {{ $row }}
                </span>
            </p>
        @endforeach
    </div>

</body>

</html>
