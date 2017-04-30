<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <title>My page title</title>


        <!-- the below three lines are a fix to get HTML5 semantic elements working in old versions of Internet Explorer-->
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        <!-- Here is our main header that is used accross all the pages of our website -->

        <header>
            <h1>Header</h1>
        </header>

        <nav>
            <ul>
                <li><a href="main.php">Strona główna</a></li>
                <li><a href="userdetails.php">Moje konto</a></li>
                <li><a href="#">Wyloguj</a></li>
            </ul>
        </nav>

        <main>

            <!-- It contains an article -->
            <section>
                <h2>Wszystkie wpisy użytkownika:</h2>
                <article>

                    <h3>Dnia:</h3>

                    <p>Jakaś data</p>

                    <h3>Użytkownik</h3>

                    <p>Na przykład Pan Andrzej</p>

                    <h3>Treść wpisu</h3>

                    <p>Donec viverra mi quis quam pulvinar at malesuada arcu rhoncus. Cum soclis natoque penatibus et manis dis parturient montes, nascetur ridiculus mus. In rutrum accumsan ultricies. Mauris vitae nisi at sem facilisis semper ac in est.</p>

                </article>
            </section>


        </main>

        <!-- And here is our main footer that is used across all the pages of our website -->

        <footer>
            <p>©Copyright 2017 by nobody. All rights reversed.</p>
        </footer>

    </body>
</html>