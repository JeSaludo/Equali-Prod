<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mail</title>
    </head>

    <body>

        <p>Congratulations! You're Qualified.</p>

        <p>Dear {{ $get_last_name . ', ' . $get_first_name }},</p>

        <p>We are pleased to inform you that you have successfully passed the recent exam. Your hard work, dedication,
            and commitment to excellence have paid off, and your results reflect your outstanding effort and knowledge
            in the subject matter.</p>

        <p>Marinduque State College<br>
            (042) 332 2028</p>

        <p>Should you have any questions or require further assistance, please do not hesitate to reach out.</p>

        <p>Best regards,<br>
            Marinduque State College<br>
            (042) 332 2028</p>

    </body>

</html>
