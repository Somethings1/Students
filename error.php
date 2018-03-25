<html>
    <head>
        <title>Error</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: 'Segoe UI', Verdana, Roboto, Courier;
                font-weight: lighter;
            }
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: rgb(10, 4, 39);
                width: 100%;
                height: 100%;
            }
            .noti {
                height: 70%;
                width: 70%;
                color: white;
                line-height: 2;
            }
            h1 {
                font-size: 5vw;
            }
            h2 {
                font-size: 2.5vw;
            }
            p {
                font-size: 1.5vw;
            }
            .button {
                display: inline-block;
                box-sizing: border-box;
                border: 1px solid white;
                padding: 0 2%;
                border-radius: 5px;
                color: lightgray;
                text-decoration: none;
                cursor: pointer;
                transition: 0.3s ease;
                font-size: 1.5vw;
            }
            .button:hover {
                border-color: rgb(10, 4, 39);
                color: white;
            }
            ::selection {
                background-color: white;
                color: black;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="noti">
                <h1>Oh, snap! :((</h1>
                <h2>Sorry. An unknown error occurred while connecting to server. Please try again later.</h2>
                <p><?php echo isset($_GET['messerror']) ? "More info: " . $_GET['messerror'] : "" ?></p>
                <a class="button" onClick="window.history.back()">Back</a>
            </div>
        </div>
    </body>
</html>