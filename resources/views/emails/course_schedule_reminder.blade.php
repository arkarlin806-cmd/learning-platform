<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Course Reminder</title>

</head>

<body style="margin:0;padding:30px;background:#f5f7fb;">

    <table
        width="100%"
        cellpadding="0"
        cellspacing="0">

        <tr>

            <td align="center">

                <table
                    width="650"
                    style="
background:#ffffff;
border-radius:18px;
overflow:hidden;
font-family:Arial,sans-serif;
">

                    <tr>

                        <td
                            style="
background:#4F46E5;
padding:30px;
text-align:center;
color:white;
font-size:28px;
font-weight:bold;
">

                            Learning Platform

                        </td>

                    </tr>

                    <tr>

                        <td style="padding:35px;">

                            <h2
                                style="
margin-top:0;
color:#222;
">

                                Course Reminder

                            </h2>

                            <p>

                                Hello,

                            </p>

                            <p>

                                This is a reminder that your course will start in

                                <strong>

                                    3 Minutes

                                </strong>

                                .

                            </p>

                            <table
                                width="100%"
                                style="
margin-top:25px;
background:#F9FAFB;
border-radius:10px;
padding:20px;
">

                                <tr>

                                    <td>

                                        <b>

                                            Course

                                        </b>

                                    </td>

                                    <td>

                                        {{ $course->title }}

                                    </td>

                                </tr>

                                <tr>

                                    <td>

                                        <b>

                                            Schedule

                                        </b>

                                    </td>

                                    <td>

                                        {{ $schedule->title }}

                                    </td>

                                </tr>

                                <tr>

                                    <td>

                                        <b>

                                            Start Time

                                        </b>

                                    </td>

                                    <td>

                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('d M Y h:i A') }}

                                    </td>

                                </tr>

                                <tr>

                                    <td>

                                        <b>

                                            End Time

                                        </b>

                                    </td>

                                    <td>

                                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('d M Y h:i A') }}

                                    </td>

                                </tr>

                            </table>

                            <p
                                style="
margin-top:25px;
">

                                Please join the course on time.

                            </p>

                            <p>

                                Good Luck.

                            </p>

                        </td>

                    </tr>

                    <tr>

                        <td
                            style="
background:#F3F4F6;
padding:18px;
text-align:center;
font-size:13px;
color:#666;
">

                            © {{ date('Y') }}

                            Learning Platform

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

    </table>

</body>

</html>