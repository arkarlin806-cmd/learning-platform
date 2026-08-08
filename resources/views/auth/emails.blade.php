<!DOCTYPE html>
<html>

<head>
    <title>Password OTP</title>
</head>


<body style="
background:#f3f4f6;
font-family:Arial,sans-serif;
padding:30px;
">


    <div style="
max-width:500px;
margin:auto;
background:white;
padding:30px;
border-radius:20px;
box-shadow:0 10px 30px rgba(0,0,0,.1);
">


        <h2 style="
text-align:center;
color:#2563eb;
">
            Password Verification
        </h2>


        <p>
            Hello,
        </p>


        <p>
            Your OTP code for password reset is:
        </p>



        <h1 style="
text-align:center;
letter-spacing:10px;
color:#7c3aed;
">

            {{ $otp }}

        </h1>



        <p>
            This OTP will expire in
            <strong>5 minutes</strong>.
        </p>



        <p style="
color:#6b7280;
font-size:14px;
">

            If you did not request this password change,
            please ignore this email.

        </p>



    </div>


</body>

</html>