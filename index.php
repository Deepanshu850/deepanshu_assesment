<?php include "connection.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>Deepanshu</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>.error{
    color: red;
}</style>

<body style=" background-color:LightGray">
 
    <main id="main">

        <section id="contact" class="contact">

            <div class="container" data-aos="fade-up">

                <div>

                </div>

                <div class="row mt-5">


                    <div class="col-lg-8 mt-5 mt-lg-0">

                        <?php

                        use PHPMailer\PHPMailer\PHPMailer;

                        use PHPMailer\PHPMailer\Exception;

                        require 'PHPMailer/src/Exception.php';

                        require 'PHPMailer/src/PHPMailer.php';

                        require 'PHPMailer/src/SMTP.php';

                        $name = $email = $message = $phone = '';

                        $nameError = $emailError = $messageError = $phoneError = '';

                        $successMessages = '';


                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                            if (empty($_POST['name'])) {

                                $nameError = '**Name is required';
                            } else {

                                $name = Deepanshu_input($_POST['name']);
                            }
                            if (empty($_POST['phone'])) {

                                $phoneError = '**phone no is required';
                            } else {

                                $phone = Deepanshu_input($_POST['phone']);
                            }

                            if (empty($_POST['email'])) {

                                $emailError = '**Email is required';
                            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

                                $emailError = 'Invalid email format';
                            } else {

                                $email = Deepanshu_input($_POST['email']);
                            }

                            if (empty($_POST['message'])) {

                                $messageError = '**Message is required';
                            } else {

                                $message = Deepanshu_input($_POST['message']);
                            }


                            if (empty($nameError) && empty($emailError) && empty($messageError)) {
                                
                                 $name = $_POST['name'];
                                $phone = $_POST['phone'];
                                $email = $_POST['email'];
                                $message = $_POST['message'];
                                $sql = "INSERT INTO `contactform`( `name`, `phone`, `email`, `message`) VALUES ('$name','$phone','$email','$message')";
                                $result = mysqli_query($conn, $sql);

                                $mail = new PHPMailer();

                                try {

                                    $mail->isSMTP();

                                    $mail->Host = 'smtp.gmail.com';

                                    $mail->Port = 587;

                                    $mail->SMTPSecure = 'tls';

                                    $mail->SMTPAuth = true;

                                    $mail->Username =  'dipanshu23kumar@gmail.com';

                                    $mail->Password =  'oxkgzguwrgnsrhgr';

                                    $mail->setFrom($email, $name);

                                    $mail->addAddress('dipanshu23kumar@gmail.com');

                                    $mail->Subject = 'Techsolv IT Service';

                                    $mail->Body = '<html>

 <head>

    <style>

        body {

            font-family: Arial, sans-serif;

            background-color: Gray;

            margin: 0;

            padding: 0;

        }

        
        .container {

            max-width: 600px;

            margin: 0 auto;

            background-color:rgb(255, 255, 235);

            padding: 20px;

            border-radius: 4px;

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }

        h1 {

            color: rgb(255, 0, 0);

            font-size: 24px;

            margin-bottom: 20px;

        }

        p {

            color:Gray;

            font-size: 16px;

            margin-bottom: 10px;
        }

    </style>

</head>

<body>

    <div class="container">

        <h1>Deepanshu Assessment</h1>

        <p><strong>Name --> </strong>  ' . $name . '</p>
        <p><strong>phone --> </strong>  ' . $phone . '</p>

        <p><strong>Email --> </strong>  ' . $email . '</p>

        <p><strong>Message --> </strong>  ' . nl2br($message) . '</p>

    </div>

</body>

</html>';

                                    $mail->isHTML(true);

                                    $mail->send();

                                    $successMessages = 'Thank you for your message!';

                                    $name = $email = $message = '';
                                } catch (Exception $e) {

                                    $errorMessage = 'Oops, something went wrong. Please try again later.';
                                }
                            }
                        }

                        function Deepanshu_input($data)

                        {
                            $data = trim($data);

                            $data = stripslashes($data);

                            $data = htmlspecialchars($data);

                            return $data;
                        }

                        ?>

                        <style>
                        hr {

                            border: 1px solid red;

                        }
                        </style>
 
                        <form method="post" style="margin-left:220px "
                            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                          <h1 class="mb-4 text-primary">Salon Deepanshu</h1>
                            <div class="form-group">

                                <label for="name"><b> Name:</b></label>

                                <input type="text" class="form-control form-control-sm" name="name"
                                    value="<?php echo $name; ?>">

                                <span class="error"><?php echo $nameError; ?></span><br><br>

                            </div>
                            <div class="form-group">

                                <label for="phone"><b> phone:</b></label>

                                <input type="text" class="form-control form-control-sm" name="phone"
                                    value="<?php echo $phone; ?>">

                                <span class="error"><?php echo $phoneError; ?></span><br><br>

                            </div>

                            <div class="form-group">

                                <label for="email"><b>Email:</b></label>

                                <input type="email" class="form-control form-control-sm" name="email"
                                    value="<?php echo $email;?>">

                                <span class="error"><?php echo $emailError; ?></span><br><br>

                            </div>

                            <div class="form-group">

                                <label for="message"><b>Message:</b></label>

                                <textarea name="message"
                                    class="form-control form-control-sm"><?php echo $message; ?></textarea>

                                <span class="error"><?php echo $messageError;?></span><br><br>

                            </div>

                            <input type="submit" class=" btn  rounded-pill btn-lg  btn-outline-info" name="submit"
                                value="          Submit          ">

                        </form>

                        <?php

                        if (!empty($successMessages)) {

                            // echo '<p style="color: green;">' . $successMessages . '</p>';
                            ?><script>Swal.fire({
                                title: 'Msg sent sucessfully to the Deepanshu',
                                width: 600,
                                padding: '3em',
                                color: '#716add',
                               
                                backdrop: `
                                  rgba(0,0,123,0.4)
                                  url("/images/nyan-cat.gif")
                                  left top
                                  no-repeat
                                `
                              })</script><?php
                        }

                        if (!empty($errorMessage)) {

                            echo '<p style="color: red;">' . $errorMessage . '</p>';
                        }

                        ?>

                    </div>
                </div>

            </div>

        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>