<html>
<head>
    <title>Avís de propietats noves</title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <style type="text/css">
        html,
        body,
        p {

        }

        h1 {
            color: #fffdf9;
        }

        a {
            text-decoration: underline;
            color: #eb9788;
        }

        a:hover {
            text-decoration: none;
            color: #fff2e5;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        * img[tabindex="0"] + div {
            display: none !important;
        }
    </style>
</head>
<body bgcolor="#fff2e5" background="#fff2e5" style="font-family: sans-serif;background-color: #fff2e5;font-size: 16px;line-height: 21px;color: #8ac6d1;margin: 0px;padding: 0px;">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td>
            <table align="center" bgcolor="#fff2e5" border="0" cellpadding="0" cellspacing="0" style="background-color: #fff2e5;" width="600">
                <tbody>
                <tr>
                    <td align="center" bgcolor="#fff2e5" style="background-color: #fff2e5;" valign="middle" width="600" height="40">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td align="center" bgcolor="#fff2e5" style="background-color: #fff2e5;font-size: 13px;" valign="middle" width="600">
                        <table bgcolor="#fff2e5" border="0" cellpadding="0" cellspacing="0" style="background-color: #fff2e5;" width="600">
                            <tr>
                                <td width="316" valign="top" align="left" bgcolor="#fff2e5" height="60" style="background-color: #fff2e5;text-align: left;">
                                   <img alt="Logo Real State Checker" width="100" height="100" src="{{asset('img/logo.png')}}" style="border: 0;text-decoration: none;"/>
                                </td>
                                <td width="284" valign="bottom" align="right" bgcolor="#fff2e5" height="60" style="background-color: #fff2e5;text-align: right;">
                                    <p style="text-align: right;color: #b7472a;font-size: 12px;text-transform: uppercase;">
                                        {{ \Carbon\Carbon::now()->format('d-m-Y') }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" bgcolor="#fff2e5" style="background-color: #fff2e5;" valign="middle" width="600" height="50">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td align="center" bgcolor="#fff2e5" style="background-color: #fff2e5;font-size: 13px;" valign="middle" width="600">
                        <table>
                            <tr>
                                <td width="100">&nbsp;</td>
                                <td width="400" valign="top" style="text-align: center;" align="center">
                                    @yield('content')
                                </td>
                                <td width="100">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" bgcolor="#fff2e5" style="background-color: #fff2e5;" valign="middle" width="600" height="100">
                        &nbsp;
                    </td>
                </tr>

                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
