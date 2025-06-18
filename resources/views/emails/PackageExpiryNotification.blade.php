<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #435d7d; color: white; padding: 20px; text-align: center; }
        .content { background: #f8f9fa; padding: 20px; border-radius: 5px; }
        .footer { text-align: center; margin-top: 20px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Package Expiry Notice</h2>
        </div>
        <div class="content">
            <p>Dear {{ $resident->res_name ?? '' }},</p>
            
            <p>This is to inform you that your package will expire tomorrow.</p>
            
            <h3>Package Details:</h3>
            <ul>
                <li>Package Name: {{ $package->package_name ?? '' }}</li>
                <li>Expiry Date: {{ $package->credit_due ?? '' }}</li>
            </ul>
            
            <p>Please contact support if you wish to renew your package.</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>