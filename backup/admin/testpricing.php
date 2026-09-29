<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pricing Comparison Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .comparison-table {
            margin: 50px 0;
        }
        .comparison-table th, .comparison-table td {
            text-align: center;
            vertical-align: middle;
            padding: 15px;
            border: none;
        }
        .comparison-table thead th {
            font-size: 18px;
            border: none;
        }
        .comparison-table thead th:first-child {
            border-top-left-radius: 15px;
        }
        .comparison-table thead th:last-child {
            border-top-right-radius: 15px;
        }
        .plan-header {
            padding: 20px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            color: #fff;
        }
        .plan-header.basic {
            background-color: #3498db;
        }
        .plan-header.standard {
            background-color: #2ecc71;
        }
        .plan-header.premium {
            background-color: #e74c3c;
        }
        .feature {
            font-weight: bold;
            padding-left: 20px;
            text-align: left;
        }
        .feature-point {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .feature-point span {
            display: inline-block;
            width: 12px;
            height: 12px;
            margin-right: 10px;
            border-radius: 50%;
        }
        .feature-point .yes {
            background-color: green;
        }
        .feature-point .no {
            background-color: red;
        }
        .panel {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .panel-heading {
            border-radius: 10px 10px 0 0;
        }
        .btn-primary {
            background-color: #3498db;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
        @media (max-width: 768px) {
            .comparison-table {
                margin: 20px 0;
            }
            .comparison-table th, .comparison-table td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row comparison-table">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th class="plan-header basic">Basic Plan</th>
                        <th class="plan-header standard">Standard Plan</th>
                        <th class="plan-header premium">Premium Plan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="feature">Storage</td>
                        <td>10 GB</td>
                        <td>50 GB</td>
                        <td>Unlimited</td>
                    </tr>
                    <tr>
                        <td class="feature">Bandwidth</td>
                        <td>100 GB</td>
                        <td>500 GB</td>
                        <td>Unlimited</td>
                    </tr>
                    <tr>
                        <td class="feature">Email Accounts</td>
                        <td>5</td>
                        <td>20</td>
                        <td>Unlimited</td>
                    </tr>
                    <tr>
                        <td class="feature">24/7 Support</td>
                        <td class="feature-point"><span class="yes"></span>Yes</td>
                        <td class="feature-point"><span class="yes"></span>Yes</td>
                        <td class="feature-point"><span class="yes"></span>Yes</td>
                    </tr>
                    <tr>
                        <td class="feature">Priority Support</td>
                        <td class="feature-point"><span class="no"></span>No</td>
                        <td class="feature-point"><span class="yes"></span>Yes</td>
                        <td class="feature-point"><span class="yes"></span>Yes</td>
                    </tr>
                    <tr>
                        <td class="feature">Dedicated Support</td>
                        <td class="feature-point"><span class="no"></span>No</td>
                        <td class="feature-point"><span class="no"></span>No</td>
                        <td class="feature-point"><span class="yes"></span>Yes</td>
                    </tr>
                    <tr>
                        <td class="feature">Monthly Price</td>
                        <td>$19</td>
                        <td>$49</td>
                        <td>$99</td>
                    </tr>
                    <tr>
                        <td class="feature"></td>
                        <td><button class="btn btn-primary btn-block">Sign Up</button></td>
                        <td><button class="btn btn-primary btn-block">Sign Up</button></td>
                        <td><button class="btn btn-primary btn-block">Sign Up</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
