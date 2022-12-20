<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p><strong>Dear Customer</strong></p>
    <p>Your policy has been created successfully.</p>
    <p>Policy ID: {{ $policyId }}</p>
    <p>Validity: {{ $startDate . ' - ' . $endDate }}</p>
    <p>Please visit instasure.xyz</p>
    <div>
        <p>For any query please contact our support.</p>
        <p><strong>Best Regards</strong></p>
        <p>Instasure</p>
        <p>09606252525</p>
    </div>

</body>

</html>
