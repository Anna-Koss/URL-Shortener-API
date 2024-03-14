# Вітаю, шановні

This application provides an API for shortening long URLs, and also collects statistics about the number of clicks on shortened URls. <br>

<h3> Built With:</h3>
- PHP 8.2 <br>
- Symfony 6.4 <br>
- Doctrine ORM <br>
- MySQL 8.0 <br>

<h3> To run the application</h3>
<ul>
<li> to clone the project write in WSL console:  </li>
<pre>           <code> git clone https://github.com/Anna-Koss/URL-Shortener-API.git </code></pre> 
<li> run the docker on your computer</li>
<li> to run container write in WSL console:</li> 
 <pre>           <code> docker-compose up -d </code></pre>
<li> then </li>
<pre>           <code> docker-compose exec php bash </code></pre> 
</ul>

<h3> Then inside container: </h3>
<ul>
<li> install the dependencies from composer.json</li>
<pre>           <code> composer install </code></pre> 
<li> run the migrations </li>
<pre>           <code> php bin/console doctrine:migrations:migrate </code></pre> 
<li> Application is ready to work </li>
<li> Application will be available at <code> http://localhost:8080 </code> </li>
</ul>



<h3>How it works</h3>
I believe that the most simple and convenient way to try how the application works is to use Postman.
My application assumes that the links to be shortened come using the POST method, for example, from some form.
Postman allows to test this and to see clearly what the response comes. Or you can use CURL <br>

<pre>       <code> curl --location 'http://localhost:8080/api/shorten-url' \
        --form 'originalUrl="https://www.php.net/manual/ru/function.filter-var.php" </code></pre>

Also the result of these actions can be observed in the DB - new records are added and the visited counter is changed <br>

Check how the received shortened links and redirects work better directly from the browser

<br>
<br>
<br>
<br>
<br>
<br>
